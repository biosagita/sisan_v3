<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Counter {
	
	function __construct(){
		parent::__construct();

		$this->load->model('transaksi_model','transaksix');
		$this->load->model('settings_model','settingsx');
	}
	
	function index() {
		$this->viewing();
	}
	
	function viewing() {
		$this->_data['warna_box'] 	= $this->settingsx->where(array('sett_keterangan' => 'Dashbordloket'))->get_all();
		$resTmp = $this->transaksix->get_loket_info();
		/*if(empty($res['layanan_info'])) {
            $res = $this->transaksix->get_loket_info(false);
        }*/
        $res = $this->transaksix->get_all_loket_info();
        if(!empty($res)) {
            foreach ($res as $key => $value) {
                if(!empty($resTmp[$key])) {
                    $res[$key] = $resTmp[$key];
                }
            }
        }

		$this->_data['lokets'] 	= $res;
		$this->_data['ajax_load_dashboard'] 	= site_url('dashboard_main/main/ajax_load_dashboard');
		
		//using lib template
		$this->template->set('title', 'Antrian : Loket Dashboard');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_dashboard/main', 'index', $this->_data);
	}

	function ajax_load_dashboard() {
		$this->_data['warna_box'] 	= $this->settingsx->where(array('sett_keterangan' => 'Dashbordloket'))->get_all();
        $resTmp = $this->transaksix->get_loket_info();
        /*if(empty($res['layanan_info'])) {
            $res = $this->transaksix->get_loket_info(false);
        }*/
        $res = $this->transaksix->get_all_loket_info();
        if(!empty($res)) {
            foreach ($res as $key => $value) {
                if(!empty($resTmp[$key])) {
                    $res[$key] = $resTmp[$key];
                }
            }
        }
		$this->_data['lokets'] 	= $res;

		$this->load->view('load_dashboard', $this->_data);
	}

}

?>