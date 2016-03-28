<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hmvc extends MX_Controller {
	public function index()	{
		$this->load->view('hmvc_view');
	}

	public function embed()	{
		$this->load->view('hmvc_embed');
	}
}
 
/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */