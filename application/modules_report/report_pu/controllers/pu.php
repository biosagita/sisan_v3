<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pu extends MY_Admin {
	private $_template 			= 'template_admin/main';
	private $_module_controller = 'report_pu/pu/';
	private $_table_name 		= 'transaksi_log';
	private $_table_field_pref 	= 'trans_';
	private $_table_pk 			= 'trans_id_transaksi';
	private $_model_crud 		= 'reportpu_model';

	private $_page_title 		= 'Antrian : Admin Laporan Performance User';
	private $_page_content_info	= array(
		'title' => 'Data Admin Performance User',
		'desc' 	=> 'List laporan performance user',
	);

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin_id')) {
			redirect('backend_login/login');
			exit();
		}
	}
	
	function index() {
		$this->lists();
	}

	function lists() {
		$this->_data['ajax_lists'] 			= site_url($this->_module_controller . 'lists_ajax');
		$this->_data['ajax_form_add'] 		= site_url($this->_module_controller . 'add_ajax');
		$this->_data['ajax_form_edit'] 		= site_url($this->_module_controller . 'edit_ajax');
		$this->_data['ajax_action_delete'] 	= site_url($this->_module_controller . 'do_delete_ajax');

		$this->_data['info_page'] = $this->_page_content_info;

		//using lib template
		$this->template->set('title', $this->_page_title);
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load($this->_template, 'lists', $this->_data);
	}

	function page_content_ajax() {
		$this->load->model('adminuser_model','adminuserx');
		$this->_data['option_user']	= $this->adminuserx->get_option();

		$this->_data['page_content_ajax'] 			= site_url($this->_module_controller . 'page_content_ajax');
		$this->_data['ajax_lists_filter_wtc'] 		= site_url('report_wtcsummary/wtcsummary/lists_ajax_filter_wtc');
		$this->_data['ajax_lists_filter_wl'] 		= site_url('report_wlsummary/wlsummary/lists_ajax_filter_wl');

		$this->_data['info_page'] = $this->_page_content_info;

		$this->load->view('lists', $this->_data);
	}
	
}

?>