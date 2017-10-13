<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends MX_Controller {
	var $_data;
	
	function __construct(){
		parent::__construct();

		$this->load->helper('main');
		$this->load->helper('cookie');
		
		$this->_data['cookie_name'] = 'cookie_loket_destination';
		$this->_data['cookie_loket_id'] = $this->input->cookie($this->_data['cookie_name'],true);
	}
}

class MY_Counter extends MY_Controller {
	var $_data;
	
	function __construct(){
		parent::__construct();

		/* Model Load */
		$this->load->model('adminuser_model','users');
		
		/* Assets Load */
		$this->config->load('assets');
		
		$path_web 			= $this->config->item('backstage');
		$path_web_counter 	= $this->config->item('counter');
        $path_web_front 			= $this->config->item('frontend');
		
		$this->_data['assets'] 			= site_url($path_web['assets']);
		$this->_data['assets_counter'] 	= site_url($path_web_counter['assets']);
        $this->_data['assets_front'] 			= site_url($path_web_front['assets']);

		$arrUserLevel = array(
			'Superadmin',
			'Admin',
			'Counter',
			'Demo'
		);
		
		/* Login Checking */
		$this->_data['is_admin_logged_in'] 	= $this->session->userdata('is_admin_logged_in');
		$this->_data['admin_username'] 		= $this->session->userdata('admin_username');
		$this->_data['admin_id'] 			= $this->session->userdata('admin_id');
		$this->_data['admin_userlevel'] 	= !empty($arrUserLevel[$this->session->userdata('admin_userlevel')]) ? $arrUserLevel[$this->session->userdata('admin_userlevel')] : '';
		$this->_data['is_admin_banned'] 	= $this->session->userdata('is_admin_banned');
		
		/* Url Home */
		$this->_data['url_home'] 			= site_url('backend_admin/admin/lists');

		$this->_data['url_login'] 		= site_url('counter_login/login');
		$this->_data['url_logout'] 		= site_url('counter_logout/logout');
	}
}

class MY_Admin extends MY_Controller {
	var $_data;
	
	function __construct(){
		parent::__construct();

		/* Model Load */
		$this->load->model('adminuser_model','users');
		
		/* Assets Load */
		$this->config->load('assets');
		
		$path_web = $this->config->item('backstage');
		
		$this->_data['assets'] 	= site_url($path_web['assets']);

		$arrUserLevel = array(
			'Superadmin',
			'Admin',
			'Counter',
			'Demo'
		);
		
		/* Login Checking */
		$this->_data['is_admin_logged_in'] 	= $this->session->userdata('is_admin_logged_in');
		$this->_data['admin_username'] 		= $this->session->userdata('admin_username');
        $this->_data['admin_image'] 		= site_url('assets/backstage/upload/'.$this->session->userdata('admin_image'));
		$this->_data['admin_id'] 			= $this->session->userdata('admin_id');
		$this->_data['admin_userlevel'] 	= !empty($arrUserLevel[$this->session->userdata('admin_userlevel')]) ? $arrUserLevel[$this->session->userdata('admin_userlevel')] : '';
		$this->_data['is_admin_banned'] 	= $this->session->userdata('is_admin_banned');
		
		/* Url Home */
		$this->_data['url_home'] 			= site_url('backend_admin/admin/lists');

		$this->_data['url_login'] 		= site_url('backend_login/login');
		$this->_data['url_logout'] 		= site_url('backend_logout/logout');

		$this->_data['menu_sidebar'] 	= array(
			array(
				'label' => 'Dashboard',
				'child'	=> array(
					array(
						'label' => 'Loket',
						'url_link' => site_url('dashboard/loket'),
					),
					array(
						'label' => 'Layanan',
						'url_link' => site_url('dashboard/layanan'),
					),
				),
			),
			array(
				'label' => 'Data Master',
				'child'	=> array(
					array(
						'label' => 'Application',
						'child'	=> array(
							array(
								'label' => 'Application Module',
								'url_link' => site_url('backend_applicationmodules/applicationmodules/page_content_ajax'),
							),
							array(
								'label' => 'Admin User Level',
								'url_link' => site_url('backend_adminlevel/adminlevel/page_content_ajax'),
							),
							array(
								'label' => 'Role Access',
								'url_link' => site_url('backend_roleaccess/roleaccess/page_content_ajax'),
							),
							array(
								'label' => 'Admin User',
								'url_link' => site_url('backend_admin/admin/page_content_ajax'),
							),
							array(
								'label' => 'User Group',
								'url_link' => site_url('backend_usergroups/usergroups/page_content_ajax'),
							),
							array(
								'label' => 'User Group Layanan',
								'url_link' => site_url('backend_usergrouplayanans/usergrouplayanans/page_content_ajax'),
							),
						),
					),
					array(
						'label' => 'Data Master',
						'child'	=> array(
							array(
								'label' => 'Company Profile',
								'url_link' => site_url('backend_companyprofile/companyprofile/page_content_ajax'),
							),
							array(
								'label' => 'Caller',
								'url_link' => site_url('backend_callers/callers/page_content_ajax'),
							),
							array(
								'label' => 'Counter Display',
								'url_link' => site_url('backend_counterdisplays/counterdisplays/page_content_ajax'),
							),
							array(
								'label' => 'Header',
								'url_link' => site_url('backend_headers/headers/page_content_ajax'),
							),
						),
					),
					array(
						'label' => 'Layanan',
						'child'	=> array(
							array(
								'label' => 'Group Layanan',
								'url_link' => site_url('backend_grouplayanans/grouplayanans/page_content_ajax'),
							),
							array(
								'label' => 'Layanan',
								'url_link' => site_url('backend_layanans/layanans/page_content_ajax'),
							),
							array(
								'label' => 'Waktu Layanan',
								'url_link' => site_url('backend_waktulayanans/waktulayanans/page_content_ajax'),
							),
							array(
								'label' => 'Prioritas Layanan',
								'url_link' => site_url('backend_prioritaslayanans/prioritaslayanans/page_content_ajax'),
							),
						),
					),
					array(
						'label' => 'Loket',
						'child'	=> array(
							array(
								'label' => 'Group Loket',
								'url_link' => site_url('backend_grouplokets/grouplokets/page_content_ajax'),
							),
							array(
								'label' => 'Loket',
								'url_link' => site_url('backend_lokets/lokets/page_content_ajax'),
							),
						),
					),
					array(
						'label' => 'Setting Display',
						'child'	=> array(
							array(
								'label' => 'Setting',
								'url_link' => site_url('backend_settings/settings/page_content_ajax'),
							),
							array(
								'label' => 'Running Text',
								'url_link' => site_url('backend_runningtexts/runningtexts/page_content_ajax'),
							),
							array(
								'label' => 'Video',
								'url_link' => site_url('backend_videos/videos/page_content_ajax'),
							),
						),
					),
					array(
						'label' => 'Laporan',
						'child'	=> array(
                            array(
                                'label' => 'All Detail Monitoring',
                                'url_link' => site_url('report_alldetailmonitoring/alldetailmonitoring/page_content_ajax'),
                            ),
							array(
								'label' => 'All Detail',
								'url_link' => site_url('report_alldetail/alldetail/page_content_ajax'),
							),
							array(
								'label' => 'Waktu Tunggu Customer (WTC)',
								'url_link' => site_url('report_wtc/wtc/page_content_ajax'),
							),
							array(
								'label' => 'WTC Summary',
								'url_link' => site_url('report_wtcsummary/wtcsummary/page_content_ajax'),
							),
							array(
								'label' => 'Waktu Layanan (WL)',
								'url_link' => site_url('report_wl/wl/page_content_ajax'),
							),
							array(
								'label' => 'WL Summary',
								'url_link' => site_url('report_wlsummary/wlsummary/page_content_ajax'),
							),
							array(
								'label' => 'Jumlah Customer Layanan (JCL)',
								'url_link' => site_url('report_jcl/jcl/page_content_ajax'),
							),
							array(
								'label' => 'Performance User (PU)',
								'url_link' => site_url('report_pu/pu/page_content_ajax'),
							),
						),
					),
				),
			),
		);
	}
}

?>