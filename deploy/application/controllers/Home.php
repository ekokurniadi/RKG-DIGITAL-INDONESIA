<?php
require APPPATH . '/third_party/Google/autoload.php';
class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('google');
	}

	public function logged_in_check()
	{
		if ($this->session->userdata("logged_in")) {
			redirect("dashboard");
		}
	}
	public function index()
	{
		$this->logged_in_check();

		$google_client = new Google_Client();
		$google_client->setClientId('1030767582963-piknfc7j34k9euo9gbepefa2rd47mvpi.apps.googleusercontent.com'); //masukkan ClientID anda 
		$google_client->setClientSecret('SAHq5PCBzPO8gfajNHATjuBj'); //masukkan Client Secret Key anda
		$google_client->setRedirectUri('http://localhost/rkg-digital/login'); //Masukkan Redirect Uri anda
		$google_client->addScope('email');
		$google_client->addScope('profile');
		$data = array();
		if (isset($_GET["code"])) {
			$google_client->authenticate($_GET['code']);
			$token = $google_client->getAccessToken();
			if (!isset($token["error"])) {
				$google_client->setAccessToken($token);
				$this->session->set_userdata('access_token', $token['access_token']);
				$google_service = new Google_Service_Oauth2($google_client);
				$data = $google_service->userinfo->get();
				$current_datetime = date('Y-m-d H:i:s');
			}
		}
		$login_button = '';
		if (!$this->session->userdata('access_token')) {

			$login_button = $google_client->createAuthUrl();
			$data['login_button'] = $login_button;
		} else {
			$login_button = $google_client->createAuthUrl();
			$data['login_button'] = $login_button;
		}

		$this->load->view('landing/index', $data);
	}
}
