<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Admin {
	
	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_id')) {
			redirect('backend');
			exit();
		}
	}
	
	function index() {
		$this->login();
	}
	
	function login() {
		$this->_data['ajax_action_login'] 	= site_url('backend_login/login/login_ajax');

		if($this->input->post('hd_login')){
			if($this->do_login()){
				redirect('backend_login/login');
				exit();
			}	
		}

		//using lib template
		$this->template->set('title', 'Antrian : Admin Login');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_login/login', 'login', $this->_data);
	}

	function login_ajax() {
		$res = array(
			'err_msg' 	=> '',
			'url_home' 	=> site_url('backend'),
		);

		if($this->input->post('hd_login')){
			if(!$this->do_login()) $res['err_msg'] = $this->_data['login_errmsg'];
		}

		echo json_encode($res);
	}
	
	function do_login(){
		$this->load->model('userlogs_model','userlogsx');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('txt_username', 'Username', 'trim|htmlspecialchars|encode_php_tags|prep_for_form|min_length[3]|required|xss_clean');
        $this->form_validation->set_rules('psw_password', 'Password', 'trim|htmlspecialchars|encode_php_tags|prep_for_form|min_length[3]|required|xss_clean');
		
		if($this->form_validation->run()) {
			$username = $this->input->post('txt_username');
			$password = $this->input->post('psw_password');
			$password = md5($password);
			
			$administrator = $this->users->where(array('admusr_username' => $username, 'admusr_userpasswd' => $password))->get_login_userlevel();
			/* User Login Success */
			if(count($administrator) > 0) {
				
				if($administrator['admusr_user_status'] == 'n'){
					$this->_data['login_errmsg'] = "Status account Anda tidak aktif. Hubungi Administrator website ini.";
					return FALSE;
				} else {
					$status = FALSE;

					if($administrator['aulv_name'] == 'Admin') {
						$status = true;
					} else {
						$this->_data['login_errmsg'] = "Status account Anda bukan admin. Hubungi Administrator website ini.";
					}

					if($status) {
						$data = $this->session->set_userdata(
							array(
								'admin_id' 					=> $administrator['admusr_id'],
								'admin_username' 			=> $administrator['admusr_username'],
                                'admin_image' 			    => (!empty($administrator['admusr_image']) ? $administrator['admusr_image'] : 'blank_user.jpg'),
								'admin_userlevel' 			=> $administrator['admusr_aulv_id'],
								'admin_usergroup' 			=> $administrator['admusr_usrgro_id'],
								'admin_usergrouplayanan' 	=> $administrator['usrgrolay_grolay_id'],
							)
						);

						$vData = array(
							'usrlog_user_id'	=> $administrator['admusr_id'],
							'usrlog_login_date'	=> date('Y-m-d H:i:s'),					           
							'usrlog_login_ip'	=> get_client_ip(),
						);

						$res = $this->userlogsx->posts($vData);
					}
					
					return $status;
				}
			} else {
				$this->_data['login_errmsg'] = "<p>Your info was incorrect. Try again.</p>";
				return FALSE;
			}
		} else {
			$this->_data['login_errmsg'] = validation_errors();
			return FALSE;
		}
	}

}

?>