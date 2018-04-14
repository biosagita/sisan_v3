<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Changeloket extends MY_Counter {
	
	function __construct(){
		parent::__construct();
	}
	
	function index() {
		$this->viewing();
	}
	
	function viewing($loket_id = '') {
		$this->load->model('lokets_model','loketsx');

		$all_loket = $this->loketsx->get_simple_changeloket();
		$this->_data['data_loket'] = $all_loket;
		$key_all_loket = array_keys($all_loket);

		if(!empty($loket_id)) {
			if(in_array($loket_id, $key_all_loket)) {
				$cookie = array(
				    'name'   => $this->_data['cookie_name'],
				    'value'  => $loket_id,
					'expire' => '86500'
				);
				 
				$this->input->set_cookie($cookie);
				redirect('counter_login/login');
				exit();
			}
		}

		//using lib template
		$this->template->set('title', 'Antrian : Loket Destination');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_loketdestination_ie6/main', 'index', $this->_data);
	}

}

?>