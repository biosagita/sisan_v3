<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Counter {
	
	function __construct(){
		parent::__construct();

		$cookieset = $this->input->cookie($this->_data['cookie_name'],true);
		if(empty($cookieset)) {
			redirect('counter_loketdestination/loketdestination');
			exit();
		}

		if($this->session->userdata('admin_id') AND (in_array($this->session->userdata('admin_userlevel'), array(1, 2)))) {
			redirect('counter');
			exit();
		}
	}
	
	function index() {
		$this->login();
	}
	
	function login() {
		$this->load->model('lokets_model','loketsx');

		$this->_data['ajax_action_login'] 	= site_url('counter_login/login/login_ajax');

		if($this->input->post('hd_login')){
			if($this->do_login()){
				redirect('counter_login/login');
				exit();
			}	
		}

		$this->_data['loket_name'] = $this->loketsx->where(array('lokets_id' => $this->_data['cookie_loket_id']))->get_loketname();
		$this->_data['url_changeloket'] = site_url('changeloket');
		
		//using lib template
		$this->template->set('title', 'Antrian : Counter Login');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->set('loket_name', $this->_data['loket_name']);
		$this->template->set('url_changeloket', $this->_data['url_changeloket']);
		$this->template->load('template_login/login', 'login', $this->_data);
	}

	function login_ajax() {
		$res = array(
			'err_msg' 	=> '',
			'url_home' 	=> site_url('counter'),
		);

		if($this->input->post('hd_login')){
			if(!$this->do_login()) $res['err_msg'] = $this->_data['login_errmsg'];
		}

		echo json_encode($res);
	}
	
	function do_login(){
		$this->load->model('userlogs_model','userlogsx');
		$this->load->model('loketlogs_model','loketlogsx');
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

					if($administrator['aulv_name'] == 'Counter') {
						$counterloket = $this->users->where(array('admusr_username' => $username, 'admusr_userpasswd' => $password, 'lokets_id' => $this->_data['cookie_loket_id']))->check_completelogin();
						if(count($counterloket) > 0) {
							$status = true;
						} else {
							$this->_data['login_errmsg'] = "User counter ini tidak sesuai dengan nomer loket. Hubungi Administrator website ini.";
						}
					} elseif($administrator['aulv_name'] == 'Demo') {
						$this->_data['login_errmsg'] = "Status account Anda Demo. Hubungi Administrator website ini.";
					} elseif($administrator['aulv_name'] == 'Admin') {
						$status = true;
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
                            'usrlog_logout_date'	=> '0000-00-00 00:00:00',
							'usrlog_login_ip'	=> get_client_ip(),
                            'usrlog_id_loket'	=> $this->_data['cookie_loket_id'],
						);

						$res = $this->userlogsx->posts($vData);

						$vData = array(
							'loklog_user_id'	=> $administrator['admusr_id'],
							'loklog_login_date'	=> date('Y-m-d H:i:s'),
                            'loklog_logout_date'	=> '0000-00-00 00:00:00',
							'loklog_lokets_id'	=> $this->_data['cookie_loket_id'],
							'loklog_login_ip'	=> get_client_ip(),
						);

						$res = $this->loketlogsx->posts($vData);
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