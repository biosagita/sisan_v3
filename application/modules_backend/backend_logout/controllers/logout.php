<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends MY_Admin {
	
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin_id')) {
			redirect('backend_login/login');
			exit();
		}
	}
	
	function index() {
		$this->logout();
	}
	
	function logout(){
		$this->load->model('userlogs_model', 'userlogsx');
		$this->userlogsx->log_logout($this->session->userdata('admin_id'));

		$data = array(
			'admin_id' 					=> '',
			'admin_username' 			=> '',
			'admin_image'               => '',
			'admin_userlevel' 			=> '',
			'admin_usergroup' 			=> '',
			'admin_usergrouplayanan' 	=> ''
		);
		
		$this->session->unset_userdata($data);
		$this->session->sess_destroy();
		
		redirect('backend/login');
		exit();
	}
	
}

?>