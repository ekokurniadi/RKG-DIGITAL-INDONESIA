<?php 
 
class Test extends CI_Controller{
	public function index(){
		
		$this->load->view('users/tes_golang');
		$this->load->view('footer');
	}
}

?>
