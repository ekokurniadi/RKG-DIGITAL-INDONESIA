
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function logged_in_check()
    {
        if ($this->session->userdata("logged_in")) {
            redirect("dashboard");
        }
    }

    function acak($panjang)
    {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter{
                $pos};
        }
        return $string;
    }

    public function index()
    {
        $this->logged_in_check();
        include_once APPPATH . "../vendor/autoload.php";
        $google_client = new Google_Client();
        $google_client->setClientId('1030767582963-piknfc7j34k9euo9gbepefa2rd47mvpi.apps.googleusercontent.com'); //masukkan ClientID anda 
        $google_client->setClientSecret('SAHq5PCBzPO8gfajNHATjuBj'); //masukkan Client Secret Key anda
        $google_client->setRedirectUri('http://localhost/rkg-digital/login'); //Masukkan Redirect Uri anda
        $google_client->addScope('email');
        $google_client->addScope('profile');

        if (isset($_GET["code"])) {
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
            if (!isset($token["error"])) {
                $google_client->setAccessToken($token['access_token']);
                $this->session->set_userdata('access_token', $token['access_token']);
                $google_service = new Google_Service_Oauth2($google_client);
                $data = $google_service->userinfo->get();
                $current_datetime = date('Y-m-d H:i:s');
                $user_data = array(
                    'nama' => $data['given_name'] . " " . $data['family_name'],
                    'username' => $data['email'],
                    "password" => $this->acak(10),
                    "profile_picture" => $data['picture'],
                    'level' => "Client",
                    'created_at' => $current_datetime
                );
                $checkEmail = $this->db->get_where('users', array('username' => $data['email']));
                if ($checkEmail->num_rows() <= 0) {
                    $this->db->insert('users', $user_data);
                }
                $checkEmail2 = $this->db->get_where('users', array('username' => $data['email']));
                $this->session->set_userdata($checkEmail2->row_array());
                $this->session->set_userdata("logged_in", true);
                if($checkEmail2->row()->lengkap==1){
                    $_SESSION['pesan'] = "Selamat datang ".$data['given_name'] . " " . $data['family_name']." di RKG DIGITAL INDONESIA, selamat beraktivitas";
                    $_SESSION['tipe'] = "success";
                }else{
                    $_SESSION['pesan'] = "Selamat datang ".$data['given_name'] . " " . $data['family_name']." di RKG DIGITAL INDONESIA, mohon lengkapi data diri anda terlebih dahulu";
                    $_SESSION['tipe'] = "success";
                }
                // redirect to dashboard
                redirect("dashboard");
            }
        }
        $login_button = '';
        if (!$this->session->userdata('access_token')) {

            $login_button = '<a href="' . $google_client->createAuthUrl() . '"><img src="https://1.bp.blogspot.com/-gvncBD5VwqU/YEnYxS5Ht7I/AAAAAAAAAXU/fsSRah1rL9s3MXM1xv8V471cVOsQRJQlQCLcBGAsYHQ/s320/google_logo.png" /></a>';
            $data['login_button'] = $login_button;
            $this->logout();
        } else {
            // uncomentar kode dibawah untuk melihat data session email
            // echo json_encode($this->session->userdata('access_token')); 
            // echo json_encode($this->session->userdata('user_data'));
            redirect("dashboard");
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('access_token');

        $this->session->unset_userdata("logged_in");
        $this->session->sess_destroy();
        echo "Logout berhasil";
        redirect(site_url('home'));
    }
}
