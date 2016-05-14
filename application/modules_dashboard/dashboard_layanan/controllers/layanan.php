<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Layanan extends MY_Counter {
	
	function __construct(){
		parent::__construct();

		$this->load->model('transaksi_model','transaksix');
		$this->load->model('settings_model','settingsx');
	}
	
	function index() {
		$this->viewing();
	}
	
	function viewing() {
		$this->_data['warna_box'] 	= $this->settingsx->where(array('sett_keterangan' => 'Dashbordlayanan'))->get_all();
		$this->_data['layanan'] 	= $this->transaksix->get_layanan_info();
		$this->_data['ajax_load_dashboard'] 	= site_url('dashboard_layanan/layanan/ajax_load_dashboard');
		
		//using lib template
		$this->template->set('title', 'Antrian : Layanan Dashboard');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_dashboard/main', 'index', $this->_data);
	}

	function ajax_load_dashboard() {
		$this->_data['warna_box'] 	= $this->settingsx->where(array('sett_keterangan' => 'Dashbordlayanan'))->get_all();
		$this->_data['layanan'] 	= $this->transaksix->get_layanan_info();

		$this->load->view('load_dashboard', $this->_data);
	}

}

?>