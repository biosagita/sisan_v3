<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends MY_Service {
	
	function __construct(){
		parent::__construct();
	}
	
	function index() {
		$this->viewing();
	}

	function gambar() {
		if(empty($_GET['source'])) exit();
		$parts = explode("/", $_GET['source']);
		$img = SERVICE_UPLOAD_IMAGE_DIR . end($parts);
		file_put_contents($img, file_get_contents($_GET['source']));
		echo "success!";
	}

}

?>