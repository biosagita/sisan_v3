<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Test_hmvc extends MX_Controller {
	public function index()	{
		$this->load->view('test_hmvc_view');
	}
}
 
/* End of file test_hmvc.php */
/* Location: ./application/controllers/test_hmvc.php */