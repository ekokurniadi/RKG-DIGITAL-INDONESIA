<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller can be accessed 
 * for (all) non logged in users
 */
class Auth extends MY_Controller
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

        $this->load->library('form_validation');
        $this->form_validation->set_rules("username", "username", "trim|required");
        $this->form_validation->set_rules("password", "password", "trim|required");
        if ($this->form_validation->run() == true) {
            $this->load->model('auth_model', 'auth');
            // check the username & password of user
            $status = $this->auth->validate();
            if ($status == ERR_INVALID_USERNAME) {
                $_SESSION['pesan'] = "User tidak terdaftar";
                $_SESSION['tipe'] = "error";
            } elseif ($status == ERR_INVALID_PASSWORD) {
                $_SESSION['pesan'] = "User tidak terdaftar";
                $_SESSION['tipe'] = "error";
            } else {
                // success
                // store the user data to session
                $this->session->set_userdata($this->auth->get_data());
                $this->session->set_userdata("logged_in", true);
                // redirect to dashboard
                redirect("dashboard");
            }
        }

        $this->load->view("auth");
    }

    public function logout()
    {
        $this->session->unset_userdata("logged_in");
        $this->session->sess_destroy();
        redirect("auth");
    }

    public function forget()
    {
        $this->load->view('forget');
    }


    public function refresh()
    {
        // Captcha configuration
        $config = array(
            'img_path'  => './captcha/',
            'img_url'  => base_url() . 'captcha/',
            'img_width'  => '130',
            'img_height' => 30,
            'border' => 0,
            'expiration' => 7200
        );
        $captcha = create_captcha($config);

        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('mycaptcha');
        $this->session->set_userdata('mycaptcha', $captcha['word']);

        // Display captcha image
        echo $captcha['image'];
    }
}
