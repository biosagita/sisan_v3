<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jcl extends MY_Admin {
	private $_template 			= 'template_admin/main';
	private $_module_controller = 'report_jcl/jcl/';
	private $_table_name 		= 'transaksi';
	private $_table_field_pref 	= 'trans_';
	private $_table_pk 			= 'trans_id_transaksi';
	private $_model_crud 		= 'reportjcl_model';

	private $_page_title 		= 'Antrian : Admin Laporan Jumlah Customer Layanan';
	private $_page_content_info	= array(
		'title' => 'Data Admin Jumlah Customer Layanan',
		'desc' 	=> 'List laporan jumlah customer layanan',
	);

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin_id')) {
			redirect('backend_login/login');
			exit();
		}
	}

	private function get_additional_field() {
		$additional_field = array(
			array(
				'field_name' 			=> 'DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal',
				'alias'					=> 'own_tanggal',
				'just_info' 			=> true,
			),
		);

		return $additional_field;
	}

	private function get_show_column() {
		$column_list = array(
			array(
				'title_header_column' 	=> 'No.',
				'field_name' 			=> $this->_table_field_pref . 'id_transaksi',
				'show_no_static' 		=> true,
				'no_order'				=> 0,
			),
			array(
				'title_header_column' 	=> 'Tanggal Transaksi',
				'field_name' 			=> 'trans_tanggal_transaksi',
				'no_order'				=> 1,
				'result_format'			=> function( $d, $row ) {
						$d = $row['own_tanggal'];
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Terlayani',
				'field_name' 			=> '0 as customer_terlayani',
				'alias'					=> 'customer_terlayani',
				'no_order'				=> 2,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_tanggal_transaksi' => $row['trans_tanggal_transaksi']))->group_by($row['groupData'])->get_customer_terlayani();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Sedang Dilayani',
				'field_name' 			=> '0 as customer_sedangdilayani',
				'alias'					=> 'customer_sedangdilayani',
				'no_order'				=> 3,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_tanggal_transaksi' => $row['trans_tanggal_transaksi']))->group_by($row['groupData'])->get_customer_sedangdilayani();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Skip',
				'field_name' 			=> '0 as customer_skip',
				'alias'					=> 'customer_skip',
				'no_order'				=> 4,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_tanggal_transaksi' => $row['trans_tanggal_transaksi']))->group_by($row['groupData'])->get_customer_skip();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Tak Terlayani',
				'field_name' 			=> '0 as customer_tak_terlayani',
				'alias'					=> 'customer_tak_terlayani',
				'no_order'				=> 5,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_tanggal_transaksi' => $row['trans_tanggal_transaksi']))->group_by($row['groupData'])->get_customer_tidakterlayani();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
		);

		return $column_list;
	}

	private function get_additional_field_layanan() {
		$additional_field = array(
			array(
				'field_name' 			=> 'lay_nama_layanan',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal',
				'alias'					=> 'own_tanggal',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'trans_id_layanan',
				'just_info' 			=> true,
			),
		);

		return $additional_field;
	}

	private function get_show_column_layanan() {
		$column_list = array(
			array(
				'title_header_column' 	=> 'No.',
				'field_name' 			=> $this->_table_field_pref . 'id_transaksi',
				'show_no_static' 		=> true,
				'no_order'				=> 0,
			),
			array(
				'title_header_column' 	=> 'Layanan',
				'field_name' 			=> 'lay_nama_layanan',
				'no_order'				=> 1,
			),
			array(
				'title_header_column' 	=> 'Tanggal Transaksi',
				'field_name' 			=> 'trans_tanggal_transaksi',
				'no_order'				=> 2,
				'result_format'			=> function( $d, $row ) {
						$d = $row['own_tanggal'];
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Terlayani',
				'field_name' 			=> '0 as customer_terlayani',
				'alias'					=> 'customer_terlayani',
				'no_order'				=> 3,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_tanggal_transaksi' => $row['trans_tanggal_transaksi'], 'trans_id_layanan' => $row['trans_id_layanan']))->group_by($row['groupData'])->get_customer_terlayani();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Sedang Dilayani',
				'field_name' 			=> '0 as customer_sedangdilayani',
				'alias'					=> 'customer_sedangdilayani',
				'no_order'				=> 4,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_tanggal_transaksi' => $row['trans_tanggal_transaksi'], 'trans_id_layanan' => $row['trans_id_layanan']))->group_by($row['groupData'])->get_customer_sedangdilayani();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Skip',
				'field_name' 			=> '0 as customer_skip',
				'alias'					=> 'customer_skip',
				'no_order'				=> 5,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_tanggal_transaksi' => $row['trans_tanggal_transaksi'], 'trans_id_layanan' => $row['trans_id_layanan']))->group_by($row['groupData'])->get_customer_skip();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Tak Terlayani',
				'field_name' 			=> '0 as customer_tak_terlayani',
				'alias'					=> 'customer_tak_terlayani',
				'no_order'				=> 6,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_tanggal_transaksi' => $row['trans_tanggal_transaksi'], 'trans_id_layanan' => $row['trans_id_layanan']))->group_by($row['groupData'])->get_customer_tidakterlayani();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
		);

		return $column_list;
	}

	private function get_show_column_all_layanan() {
		$column_list = array(
			array(
				'title_header_column' 	=> 'No.',
				'field_name' 			=> $this->_table_field_pref . 'id_transaksi',
				'show_no_static' 		=> true,
				'no_order'				=> 0,
			),
			array(
				'title_header_column' 	=> 'Layanan',
				'field_name' 			=> 'lay_nama_layanan',
				'no_order'				=> 1,
			),
			array(
				'title_header_column' 	=> 'Terlayani',
				'field_name' 			=> '0 as customer_terlayani',
				'alias'					=> 'customer_terlayani',
				'no_order'				=> 2,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_id_layanan' => $row['trans_id_layanan']))->group_by($row['groupData'])->get_customer_terlayani();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Sedang Dilayani',
				'field_name' 			=> '0 as customer_sedangdilayani',
				'alias'					=> 'customer_sedangdilayani',
				'no_order'				=> 3,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_id_layanan' => $row['trans_id_layanan']))->group_by($row['groupData'])->get_customer_sedangdilayani();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Skip',
				'field_name' 			=> '0 as customer_skip',
				'alias'					=> 'customer_skip',
				'no_order'				=> 4,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_id_layanan' => $row['trans_id_layanan']))->group_by($row['groupData'])->get_customer_skip();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Tak Terlayani',
				'field_name' 			=> '0 as customer_tak_terlayani',
				'alias'					=> 'customer_tak_terlayani',
				'no_order'				=> 5,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_id_layanan' => $row['trans_id_layanan']))->group_by($row['groupData'])->get_customer_tidakterlayani();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
		);

		return $column_list;
	}

	private function get_additional_field_loket() {
		$additional_field = array(
			array(
				'field_name' 			=> 'lokets_name',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal',
				'alias'					=> 'own_tanggal',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'trans_id_loket',
				'just_info' 			=> true,
			),
		);

		return $additional_field;
	}

	private function get_show_column_loket() {
		$column_list = array(
			array(
				'title_header_column' 	=> 'No.',
				'field_name' 			=> $this->_table_field_pref . 'id_transaksi',
				'show_no_static' 		=> true,
				'no_order'				=> 0,
			),
			array(
				'title_header_column' 	=> 'Loket',
				'field_name' 			=> 'lokets_name',
				'no_order'				=> 1,
			),
			array(
				'title_header_column' 	=> 'Tanggal Transaksi',
				'field_name' 			=> 'trans_tanggal_transaksi',
				'no_order'				=> 2,
				'result_format'			=> function( $d, $row ) {
						$d = $row['own_tanggal'];
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Terlayani',
				'field_name' 			=> '0 as customer_terlayani',
				'alias'					=> 'customer_terlayani',
				'no_order'				=> 3,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_tanggal_transaksi' => $row['trans_tanggal_transaksi'], 'trans_id_loket' => $row['trans_id_loket']))->group_by($row['groupData'])->get_customer_terlayani();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Sedang Dilayani',
				'field_name' 			=> '0 as customer_sedangdilayani',
				'alias'					=> 'customer_sedangdilayani',
				'no_order'				=> 4,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_tanggal_transaksi' => $row['trans_tanggal_transaksi'], 'trans_id_loket' => $row['trans_id_loket']))->group_by($row['groupData'])->get_customer_sedangdilayani();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Skip',
				'field_name' 			=> '0 as customer_skip',
				'alias'					=> 'customer_skip',
				'no_order'				=> 5,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_tanggal_transaksi' => $row['trans_tanggal_transaksi'], 'trans_id_loket' => $row['trans_id_loket']))->group_by($row['groupData'])->get_customer_skip();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Tak Terlayani',
				'field_name' 			=> '0 as customer_tak_terlayani',
				'alias'					=> 'customer_tak_terlayani',
				'no_order'				=> 6,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_tanggal_transaksi' => $row['trans_tanggal_transaksi'], 'trans_id_loket' => $row['trans_id_loket']))->group_by($row['groupData'])->get_customer_tidakterlayani();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
		);

		return $column_list;
	}

	private function get_show_column_all_loket() {
		$column_list = array(
			array(
				'title_header_column' 	=> 'No.',
				'field_name' 			=> $this->_table_field_pref . 'id_transaksi',
				'show_no_static' 		=> true,
				'no_order'				=> 0,
			),
			array(
				'title_header_column' 	=> 'Loket',
				'field_name' 			=> 'lokets_name',
				'no_order'				=> 1,
			),
			array(
				'title_header_column' 	=> 'Terlayani',
				'field_name' 			=> '0 as customer_terlayani',
				'alias'					=> 'customer_terlayani',
				'no_order'				=> 2,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_id_loket' => $row['trans_id_loket']))->group_by($row['groupData'])->get_customer_terlayani();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Sedang Dilayani',
				'field_name' 			=> '0 as customer_sedangdilayani',
				'alias'					=> 'customer_sedangdilayani',
				'no_order'				=> 3,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_id_loket' => $row['trans_id_loket']))->group_by($row['groupData'])->get_customer_sedangdilayani();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Skip',
				'field_name' 			=> '0 as customer_skip',
				'alias'					=> 'customer_skip',
				'no_order'				=> 4,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_id_loket' => $row['trans_id_loket']))->group_by($row['groupData'])->get_customer_skip();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Tak Terlayani',
				'field_name' 			=> '0 as customer_tak_terlayani',
				'alias'					=> 'customer_tak_terlayani',
				'no_order'				=> 5,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->database();
						$CI->load->model('transaksi_model', 'transaksix');
						$res = $this->transaksix->where(array('trans_id_loket' => $row['trans_id_loket']))->group_by($row['groupData'])->get_customer_tidakterlayani();
						$d = !empty($res['jumlah']) ? $res['jumlah'] : 0;
			            return $d;
			        },
			),
		);

		return $column_list;
	}
	
	function index() {
		$this->lists();
	}

	function lists() {
		$this->_data['ajax_lists'] 			= site_url($this->_module_controller . 'lists_ajax');
		$this->_data['ajax_form_add'] 		= site_url($this->_module_controller . 'add_ajax');
		$this->_data['ajax_form_edit'] 		= site_url($this->_module_controller . 'edit_ajax');
		$this->_data['ajax_action_delete'] 	= site_url($this->_module_controller . 'do_delete_ajax');

		$this->_data['column_list'] = $this->get_show_column();

		$this->_data['info_page'] = $this->_page_content_info;

		//using lib template
		$this->template->set('title', $this->_page_title);
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load($this->_template, 'lists', $this->_data);
	}

	function page_content_ajax() {
		$this->load->model('lokets_model','loketsx');
		$this->_data['option_loket']	= $this->loketsx->get_option();
		$this->load->model('layanans_model','layanansx');
		$this->_data['option_layanan']	= $this->layanansx->get_option();
		$this->load->model('adminuser_model','usersx');
		$this->_data['option_user']	= $this->usersx->get_option();

		$this->_data['page_content_ajax'] 		= site_url($this->_module_controller . 'page_content_ajax');
		$this->_data['ajax_lists'] 				= site_url($this->_module_controller . 'lists_ajax');
		$this->_data['ajax_lists_filter'] 		= site_url($this->_module_controller . 'lists_ajax_filter');

		$this->_data['column_list'] = $this->get_show_column();

		$this->_data['info_page'] = $this->_page_content_info;

		$this->load->view('lists', $this->_data);
	}

	function lists_ajax_filter() {
		$this->_data['column_list'] = $this->get_show_column();

		$type_summary = $this->input->post('type_summary');

		$this->_data['ajax_lists'] 	= site_url($this->_module_controller . 'lists_ajax/' . $type_summary);

		$this->_data['group_data'] 				= 'trans_tanggal_transaksi';
		$this->_data['trans_id_layanan'] 		= '';
		$this->_data['trans_id_loket'] 			= '';
		$this->_data['trans_id_user'] 			= '';
		$this->_data['trans_tanggal_transaksi'] = $this->input->post('trans_tanggal_transaksi');

		if($type_summary == 'summary_layanan') {
			$this->_data['trans_id_layanan']	= $this->input->post('trans_id_layanan');
			$this->_data['group_data']			= !empty($this->_data['trans_id_layanan']) ? 'trans_id_layanan,trans_tanggal_transaksi' : 'trans_id_layanan';
			$this->_data['column_list'] 		= !empty($this->_data['trans_id_layanan']) ? $this->get_show_column_layanan() : $this->get_show_column_all_layanan();
			$this->_data['ajax_lists'] 			= !empty($this->_data['trans_id_layanan']) ? site_url($this->_module_controller . 'lists_ajax/' . $type_summary . '/' . $this->_data['trans_id_layanan']) : $this->_data['ajax_lists'];
		}

		if($type_summary == 'summary_loket') {
			$this->_data['trans_id_loket']	= $this->input->post('trans_id_loket');
			$this->_data['group_data']		= !empty($this->_data['trans_id_loket']) ? 'trans_id_loket,trans_tanggal_transaksi' : 'trans_id_loket';
			$this->_data['column_list'] 	= !empty($this->_data['trans_id_loket']) ? $this->get_show_column_loket() : $this->get_show_column_all_loket();
			$this->_data['ajax_lists'] 		= !empty($this->_data['trans_id_loket']) ? site_url($this->_module_controller . 'lists_ajax/' . $type_summary . '/' . $this->_data['trans_id_loket']) : $this->_data['ajax_lists'];
		}

		if($type_summary == 'summary_user') {
			$this->_data['trans_id_user']	= $this->input->post('trans_id_user');
			$this->_data['group_data']		= !empty($this->_data['trans_id_user']) ? 'trans_id_user,trans_tanggal_transaksi' : 'trans_id_user';
		}

		$this->load->view('lists_filter', $this->_data);
	}

	//--- used by datatable source data -------
	function lists_ajax($type_summary = '', $value_summary = '') {
		$this->load->helper('mydatatable');
		$table 		= $this->db->dbprefix . $this->_table_name;
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'layanan ON (trans_id_layanan = lay_id_layanan) ';
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'group_layanan ON (trans_id_group_layanan = grolay_id_group_layanan) ';
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'lokets ON (trans_id_loket = lokets_id) ';
		$primaryKey = $this->_table_pk;
		$column_list = $this->get_show_column();
		if($type_summary == 'summary_layanan') $column_list = !empty($value_summary) ? $this->get_show_column_layanan() : $this->get_show_column_all_layanan();
		if($type_summary == 'summary_loket') $column_list = !empty($value_summary) ? $this->get_show_column_loket() : $this->get_show_column_all_loket();
		$columns = array();
		$cnt = 0;
		foreach ($column_list as $key => $value) {
			$columns[] = array(
				'db' 				=> $value['field_name'],
				'dt' 				=> !empty($value['no_order']) ? $value['no_order'] : $cnt,
				'formatter' 		=> !empty($value['result_format']) ? $value['result_format'] : '',
				'show_no_static' 	=> !empty($value['show_no_static']) ? $value['show_no_static'] : '',
				'just_info' 		=> !empty($value['just_info']) ? $value['just_info'] : '',
				'alias' 			=> !empty($value['alias']) ? $value['alias'] : '',
			);
			$cnt++;
		}

		$additional_field = $this->get_additional_field();
		if($type_summary == 'summary_layanan') $additional_field = $this->get_additional_field_layanan();
		if($type_summary == 'summary_loket') $additional_field = $this->get_additional_field_loket();

		if(!empty($additional_field)) {
			foreach ($additional_field as $key => $value) {
				$columns[] = array(
					'db' 				=> $value['field_name'],
					'dt' 				=> !empty($value['no_order']) ? $value['no_order'] : $cnt,
					'formatter' 		=> !empty($value['result_format']) ? $value['result_format'] : '',
					'show_no_static' 	=> !empty($value['show_no_static']) ? $value['show_no_static'] : '',
					'just_info' 		=> !empty($value['just_info']) ? $value['just_info'] : '',
					'alias' 			=> !empty($value['alias']) ? $value['alias'] : '',
				);
				$cnt++;
			}
		}

		$whereResult 	= '';
		$whereAll 		= ''; //'trans_waktu_panggil != "00:00:00"';
		generateDataTable($table, $primaryKey, $columns, $whereResult, $whereAll);
	}

	function page_export_text() {
		$this->db->select('trans_tanggal_transaksi, DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal, "-" as customer_terlayani, "-" as customer_sedangdilayani, "-" as customer_skip, "-" as customer_tak_terlayani', false);
		$this->db->from($this->_table_name);
		$this->db->join('layanan', 'trans_id_layanan = lay_id_layanan', 'left');
		$this->db->join('group_layanan', 'trans_id_group_layanan = grolay_id_group_layanan', 'left');
		$this->db->join('lokets', 'trans_id_loket = lokets_id', 'left');
		$this->db->where('trans_waktu_finish != "00:00:00" AND trans_id_loket != ""');
		$this->db->group_by('trans_tanggal_transaksi');
		$this->db->order_by('own_tanggal', 'ASC');
		$this->_data['data_master'] = $this->db->get()->result_array();
		//print_r($this->_data['data_master']);

		$this->template->set('title', 'Antrian : Export Text WL Summary');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_export/export_text', 'lists_exporttext', $this->_data);
	}

	function page_export_excel() {
		$filename = 'antrian_jcl_' . str_replace('-', '', date('Y-m-d')) . '.xls';
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename = " . $filename);
		header("Pragma: no-cache");
		header("Expires: 0");

		$this->db->select('trans_tanggal_transaksi, DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal, "-" as customer_terlayani, "-" as customer_sedangdilayani, "-" as customer_skip, "-" as customer_tak_terlayani', false);
		$this->db->from($this->_table_name);
		$this->db->join('layanan', 'trans_id_layanan = lay_id_layanan', 'left');
		$this->db->join('group_layanan', 'trans_id_group_layanan = grolay_id_group_layanan', 'left');
		$this->db->join('lokets', 'trans_id_loket = lokets_id', 'left');
		$this->db->where('trans_waktu_finish != "00:00:00" AND trans_id_loket != ""');
		$this->db->group_by('trans_tanggal_transaksi');
		$this->db->order_by('own_tanggal', 'ASC');
		$this->_data['data_master'] = $this->db->get()->result_array();
		//print_r($this->_data['data_master']);

		$this->template->set('title', 'Antrian : Export Text WL Summary');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_export/export_excel', 'lists_exportexcel', $this->_data);
	}
	
}

?>