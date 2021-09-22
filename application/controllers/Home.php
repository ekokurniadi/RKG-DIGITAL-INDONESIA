<?php

class Home extends CI_Controller
{
    public function logged_in_check()
    {
        if ($this->session->userdata("logged_in")) {
            redirect("dashboard");
        }
    }
    public function index()
    {
        $this->logged_in_check();
;        include_once APPPATH . "../vendor/autoload.php";
        $google_client = new Google_Client();
        $google_client->setClientId('1030767582963-piknfc7j34k9euo9gbepefa2rd47mvpi.apps.googleusercontent.com'); //masukkan ClientID anda 
        $google_client->setClientSecret('SAHq5PCBzPO8gfajNHATjuBj'); //masukkan Client Secret Key anda
        $google_client->setRedirectUri('http://localhost/rkg-digital/login'); //Masukkan Redirect Uri anda
        $google_client->addScope('email');
        $google_client->addScope('profile');
        $data=array();
        if (isset($_GET["code"])) {
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
            if (!isset($token["error"])) {
                $google_client->setAccessToken($token['access_token']);
                $this->session->set_userdata('access_token', $token['access_token']);
                $google_service = new Google_Service_Oauth2($google_client);
                $data = $google_service->userinfo->get();
                $current_datetime = date('Y-m-d H:i:s');
                // $user_data = array(
                //     'first_name' => $data['given_name'],
                //     'last_name'  => $data['family_name'],
                //     'email_address' => $data['email'],
                //     'profile_picture' => $data['picture'],
                //     'updated_at' => $current_datetime
                // );
                // print_r($user_data);
                // $this->session->set_userdata('user_data', $user_data);
            }
        }
        $login_button = '';
        if (!$this->session->userdata('access_token')) {
            
            $login_button = $google_client->createAuthUrl();
            $data['login_button'] = $login_button;
        } else {
            // uncomentar kode dibawah untuk melihat data session email
            // echo json_encode($this->session->userdata('access_token')); 
            // echo json_encode($this->session->userdata('user_data'));
            // echo "Login success";  
            $login_button = $google_client->createAuthUrl();
            $data['login_button'] = $login_button;

        }

        $this->load->view('landing/index',$data);
    }

    public function login()
    {
    }
}
