<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wtcsummary extends MY_Admin {
	private $_template 			= 'template_admin/main';
	private $_module_controller = 'report_wtcsummary/wtcsummary/';
	private $_table_name 		= 'transaksi';
	private $_table_field_pref 	= 'trans_';
	private $_table_pk 			= 'trans_id_transaksi';
	private $_model_crud 		= 'reportwtcsummary_model';

	private $_page_title 		= 'Antrian : Admin Laporan Waktu Tunggu Customer Summary';
	private $_page_content_info	= array(
		'title' => 'Data Admin Waktu Tunggu Customer Summary',
		'desc' 	=> 'List laporan waktu tunggu customer summary',
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
			array(
				'field_name' 			=> 'trans_waktu_ambil',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'trans_id_loket',
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
				'title_header_column' 	=> 'Rata - Rata',
				'field_name' 			=> 'SEC_TO_TIME(AVG(TIME_TO_SEC(IF(TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ) > 0, TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ), 0)))) as rata_rata',
				'alias'					=> 'rata_rata',
				'ignore_search'			=> true,
				'no_order'				=> 2,
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
				'field_name' 			=> 'trans_waktu_ambil',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'trans_id_loket',
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
				'title_header_column' 	=> 'Tanggal Transaksi',
				'field_name' 			=> 'trans_tanggal_transaksi',
				'no_order'				=> 1,
				'result_format'			=> function( $d, $row ) {
						$d = $row['own_tanggal'];
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Rata - Rata',
				'field_name' 			=> 'SEC_TO_TIME(AVG(TIME_TO_SEC(IF(TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ) > 0, TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ), 0)))) as rata_rata',
				'alias'					=> 'rata_rata',
				'ignore_search'			=> true,
				'no_order'				=> 2,
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
				'title_header_column' 	=> 'Rata - Rata',
				'field_name' 			=> 'SEC_TO_TIME(AVG(TIME_TO_SEC(IF(TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ) > 0, TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ), 0)))) as rata_rata',
				'alias'					=> 'rata_rata',
				'ignore_search'			=> true,
				'no_order'				=> 2,
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
				'field_name' 			=> 'trans_waktu_ambil',
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
				'title_header_column' 	=> 'Tanggal Transaksi',
				'field_name' 			=> 'trans_tanggal_transaksi',
				'no_order'				=> 1,
				'result_format'			=> function( $d, $row ) {
						$d = $row['own_tanggal'];
			            return $d;
			        },
			),
			array(
				'title_header_column' 	=> 'Rata - Rata',
				'field_name' 			=> 'SEC_TO_TIME(AVG(TIME_TO_SEC(IF(TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ) > 0, TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ), 0)))) as rata_rata',
				'alias'					=> 'rata_rata',
				'ignore_search'			=> true,
				'no_order'				=> 2,
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
				'title_header_column' 	=> 'Rata - Rata',
				'field_name' 			=> 'SEC_TO_TIME(AVG(TIME_TO_SEC(IF(TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ) > 0, TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ), 0)))) as rata_rata',
				'alias'					=> 'rata_rata',
				'ignore_search'			=> true,
				'no_order'				=> 2,
			),
		);

		return $column_list;
	}

	private function get_additional_field_user() {
		$additional_field = array(
			array(
				'field_name' 			=> 'admusr_username',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal',
				'alias'					=> 'own_tanggal',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'trans_waktu_ambil',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'trans_id_user',
				'just_info' 			=> true,
			),
		);

		return $additional_field;
	}

	private function get_show_column_user() {
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
				'title_header_column' 	=> 'Rata - Rata',
				'field_name' 			=> 'SEC_TO_TIME(AVG(TIME_TO_SEC(IF(TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ) > 0, TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ), 0)))) as rata_rata',
				'alias'					=> 'rata_rata',
				'ignore_search'			=> true,
				'no_order'				=> 2,
			),
		);

		return $column_list;
	}

	private function get_show_column_all_user() {
		$column_list = array(
			array(
				'title_header_column' 	=> 'No.',
				'field_name' 			=> $this->_table_field_pref . 'id_transaksi',
				'show_no_static' 		=> true,
				'no_order'				=> 0,
			),
			array(
				'title_header_column' 	=> 'Username',
				'field_name' 			=> 'admusr_username',
				'no_order'				=> 1,
			),
			array(
				'title_header_column' 	=> 'Rata - Rata',
				'field_name' 			=> 'SEC_TO_TIME(AVG(TIME_TO_SEC(IF(TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ) > 0, TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ), 0)))) as rata_rata',
				'alias'					=> 'rata_rata',
				'ignore_search'			=> true,
				'no_order'				=> 2,
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
		$this->load->model('adminuser_model','adminuserx');
		$this->_data['option_user']	= $this->adminuserx->get_option();

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
			$this->_data['column_list'] 	= !empty($this->_data['trans_id_user']) ? $this->get_show_column_user() : $this->get_show_column_all_user();
			$this->_data['ajax_lists'] 		= !empty($this->_data['trans_id_user']) ? site_url($this->_module_controller . 'lists_ajax/' . $type_summary . '/' . $this->_data['trans_id_user']) : $this->_data['ajax_lists'];
		}

		$this->_data['result'] = $this->getChartData_new($type_summary);

		$this->load->view('lists_filter', $this->_data);
	}

	function lists_ajax_filter_wtc() {
		$this->_data['column_list'] = $this->get_show_column();

		$type_summary = 'summary_user';

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
			$this->_data['column_list'] 	= !empty($this->_data['trans_id_user']) ? $this->get_show_column_user() : $this->get_show_column_all_user();
			$this->_data['ajax_lists'] 		= !empty($this->_data['trans_id_user']) ? site_url($this->_module_controller . 'lists_ajax/' . $type_summary . '/' . $this->_data['trans_id_user']) : $this->_data['ajax_lists'];
		}

		$this->_data['result'] = $this->getChartData($this->_data['trans_id_user'], $this->_data['trans_tanggal_transaksi']);

		$this->load->view('lists_filter_wtc', $this->_data);
	}

	//--- used by datatable source data -------
	function lists_ajax($type_summary = '', $value_summary = '') {
		$this->load->helper('mydatatable');
		$table 		= $this->db->dbprefix . $this->_table_name;
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'layanan ON (trans_id_layanan = lay_id_layanan) ';
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'group_layanan ON (trans_id_group_layanan = grolay_id_group_layanan) ';
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'lokets ON (trans_id_loket = lokets_id) ';
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'adminusers ON (trans_id_user = admusr_id) ';
		$primaryKey = $this->_table_pk;
		$column_list = $this->get_show_column();
		if($type_summary == 'summary_layanan') $column_list = !empty($value_summary) ? $this->get_show_column_layanan() : $this->get_show_column_all_layanan();
		if($type_summary == 'summary_loket') $column_list = !empty($value_summary) ? $this->get_show_column_loket() : $this->get_show_column_all_loket();
		if($type_summary == 'summary_user') $column_list = !empty($value_summary) ? $this->get_show_column_user() : $this->get_show_column_all_user();
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
				'ignore_search' 	=> !empty($value['ignore_search']) ? $value['ignore_search'] : '',
			);
			$cnt++;
		}

		$additional_field = $this->get_additional_field();
		if($type_summary == 'summary_layanan') $additional_field = $this->get_additional_field_layanan();
		if($type_summary == 'summary_loket') $additional_field = $this->get_additional_field_loket();
		if($type_summary == 'summary_user') $additional_field = $this->get_additional_field_user();

		if(!empty($additional_field)) {
			foreach ($additional_field as $key => $value) {
				$columns[] = array(
					'db' 				=> $value['field_name'],
					'dt' 				=> !empty($value['no_order']) ? $value['no_order'] : $cnt,
					'formatter' 		=> !empty($value['result_format']) ? $value['result_format'] : '',
					'show_no_static' 	=> !empty($value['show_no_static']) ? $value['show_no_static'] : '',
					'just_info' 		=> !empty($value['just_info']) ? $value['just_info'] : '',
					'alias' 			=> !empty($value['alias']) ? $value['alias'] : '',
					'ignore_search' 	=> !empty($value['ignore_search']) ? $value['ignore_search'] : '',
				);
				$cnt++;
			}
		}

		$whereResult 	= '';
		$whereAll 		= 'trans_waktu_ambil != "00:00:00" AND trans_id_loket != ""';
		generateDataTable($table, $primaryKey, $columns, $whereResult, $whereAll);
	}

	private function getChartData($trans_id_user, $trans_tanggal_transaksi) {
		$tgl_periode = '';

		if(!empty($trans_tanggal_transaksi)) {
			$tmpdate = explode(' - ', $trans_tanggal_transaksi);

			$start=str_replace('-','',$tmpdate[0]);
			$this->db->where('trans_tanggal_transaksi >=', $start );	

			$finish=str_replace('-','',$tmpdate[1]);
			$this->db->where('trans_tanggal_transaksi <=', $finish );
		}

		if(!empty($trans_id_user)) {
			$this->db->where('trans_id_user =', $trans_id_user );	
		}



		$vItems = array(
			'list_x'		=> array(),
			'list_y'		=> array(),
			'list_x_2'		=> array(),
			'periode'		=> $tgl_periode,
			'keterangan'	=> array(),
		);

		$vItems['listwarna'] = array(
			array(
				'rgba(255,0,0, 0.9)',
				'rgba(255,0,0, 0.9)',
				'rgba(255,0,0, 0.9)',
				'rgba(255,0,0, 0.9)',
			),
			array(
				'rgba(255,255,0, 0.9)',
				'rgba(255,255,0, 0.9)',
				'rgba(255,255,0, 0.9)',
				'rgba(255,255,0, 0.9)',
			),
			array(
				'rgba(0,255,0, 0.9)',
				'rgba(0,255,0, 0.9)',
				'rgba(0,255,0, 0.9)',
				'rgba(0,255,0, 0.9)',
			),
			array(
				'rgba(0,0,255, 0.9)',
				'rgba(0,0,255, 0.9)',
				'rgba(0,0,255, 0.9)',
				'rgba(0,0,255, 0.9)',
			),
		);

		$vItems['listwarnahex'] = array(
			'#ff0000',
			'#ffff00',
			'#00ff00',
			'#0000ff',
		);

		//hanya user yang dilayani
		$this->db->where('trans_waktu_ambil !=', '00:00:00' );
		$this->db->where('trans_id_loket !=', '' );
		//$this->db->where('a.id_user !=', '' );

		$grpx = 'admusr_username as info,';

		$this->db->Select($grpx . ",trans_tanggal_transaksi,COUNT(trans_id_layanan) as jumlah_customer, SEC_TO_TIME(AVG(TIME_TO_SEC(IF(TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ) > 0, TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ), 0)))) as rata_rata, DATE_FORMAT(trans_tanggal_transaksi, '%d-%m-%Y') as tgl_transaksi", FALSE);

		$this->db->join("layanan","trans_id_layanan = lay_id_layanan","Left");
		$this->db->join("group_layanan","trans_id_group_layanan = grolay_id_group_layanan","Left");
		$this->db->join("adminusers","trans_id_user = admusr_id","Left");
		$this->db->join("lokets AS e","trans_id_loket = lokets_id","Left");

		$this->db->order_by('trans_tanggal_transaksi','ASC');
		
		$this->db->from("transaksi");

		if(!empty($trans_id_user)) {
			$this->db->group_by(array("trans_id_user", "trans_tanggal_transaksi"));
		} else {
			$this->db->group_by(array("trans_id_user"));
		}
		
		$vResult = $this->db->get()->result();
		//echo $this->db->last_query(); exit();

		foreach($vResult as $vRow):

			if(!empty($trans_id_user)) {
				$vItems['list_x'][] = "'$vRow->tgl_transaksi'";
				$vItems['list_x_2'][] = $vRow->tgl_transaksi;
				$vItems['keterangan'][] = $vRow->tgl_transaksi . ' (<span style="display: inline-block;width:10px;height:10px;line-height: 10px;background-color:'.$vItems['listwarnahex'][0].';">&nbsp;</span> '.$vRow->rata_rata.')';
			} else {
				$vItems['list_x'][] = "'$vRow->info'";
				$vItems['list_x_2'][] = $vRow->info;
				$vItems['keterangan'][] = $vRow->info . ' (<span style="display: inline-block;width:10px;height:10px;line-height: 10px;background-color:'.$vItems['listwarnahex'][0].';">&nbsp;</span> '.$vRow->rata_rata.')';
			}
			
			$vItems['list_y'][] 	= $this->convert_minute($vRow->rata_rata);
           
		endforeach;

		return $vItems;
	}

	private function convert_second($time) {
		$tmp = explode(':', $time);
		$total = 0;
		$total += ((int) $tmp[0]) * 3600;
		$total += ((int) $tmp[1]) * 60;
		$total += (int) $tmp[2];
		return $total;
	}

	private function convert_minute($time) {
		$tmp = explode(':', $time);
		$total = 0;
		$total += ((int) $tmp[0]) * 60;
		$total += (int) $tmp[1];
		$total += round((((int) $tmp[2]) / 60), 1);
		return $total;
	}

	function page_export_text() {
		$this->db->select('trans_tanggal_transaksi, DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal, SEC_TO_TIME(AVG(TIME_TO_SEC(IF(TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ) > 0, TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ), 0)))) as rata_rata', false);
		$this->db->from($this->_table_name);
		$this->db->join('layanan', 'trans_id_layanan = lay_id_layanan', 'left');
		$this->db->join('group_layanan', 'trans_id_group_layanan = grolay_id_group_layanan', 'left');
		$this->db->join('lokets', 'trans_id_loket = lokets_id', 'left');
		$this->db->join('adminusers', 'trans_id_user = admusr_id', 'left');
		$this->db->where('trans_waktu_ambil != "00:00:00" AND trans_id_loket != ""');
		$this->db->group_by('trans_tanggal_transaksi');
		$this->db->order_by('own_tanggal', 'ASC');
		$this->_data['data_master'] = $this->db->get()->result_array();
		//print_r($this->_data['data_master']);

		$this->template->set('title', 'Antrian : Export Text WTC Summary');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_export/export_text', 'lists_exporttext', $this->_data);
	}

	function page_export_excel() {
		$filename = 'antrian_wtc_summary_' . str_replace('-', '', date('Y-m-d')) . '.xls';
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename = " . $filename);
		header("Pragma: no-cache");
		header("Expires: 0");

		$this->db->select('trans_tanggal_transaksi, DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal, SEC_TO_TIME(AVG(TIME_TO_SEC(IF(TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ) > 0, TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ), 0)))) as rata_rata', false);
		$this->db->from($this->_table_name);
		$this->db->join('layanan', 'trans_id_layanan = lay_id_layanan', 'left');
		$this->db->join('group_layanan', 'trans_id_group_layanan = grolay_id_group_layanan', 'left');
		$this->db->join('lokets', 'trans_id_loket = lokets_id', 'left');
		$this->db->join('adminusers', 'trans_id_user = admusr_id', 'left');
		$this->db->where('trans_waktu_ambil != "00:00:00" AND trans_id_loket != ""');
		$this->db->group_by('trans_tanggal_transaksi');
		$this->db->order_by('own_tanggal', 'ASC');
		$this->_data['data_master'] = $this->db->get()->result_array();
		//print_r($this->_data['data_master']);

		$this->template->set('title', 'Antrian : Export Excel WTC Summary');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_export/export_excel', 'lists_exportexcel', $this->_data);
	}

	private function getChartData_new($type_summary) {
		$tgl_periode = '';

		$trans_tanggal_transaksi = !empty($this->_data['trans_tanggal_transaksi']) ? $this->_data['trans_tanggal_transaksi'] : '';
		$trans_id_user = !empty($this->_data['trans_id_user']) ? $this->_data['trans_id_user'] : '';
		$trans_id_layanan = !empty($this->_data['trans_id_layanan']) ? $this->_data['trans_id_layanan'] : '';
		$trans_id_loket = !empty($this->_data['trans_id_loket']) ? $this->_data['trans_id_loket'] : '';

		//echo $trans_id_user;
		//echo $trans_id_layanan;
		//echo $trans_id_loket;
		//exit();

		if(!empty($trans_tanggal_transaksi)) {
			$tmpdate = explode(' - ', $trans_tanggal_transaksi);

			$start=str_replace('-','',$tmpdate[0]);
			$this->db->where('trans_tanggal_transaksi >=', $start );	

			$finish=str_replace('-','',$tmpdate[1]);
			$this->db->where('trans_tanggal_transaksi <=', $finish );
		}

		if(!empty($trans_id_user)) {
			$this->db->where('trans_id_user =', $trans_id_user );	
		}

		if(!empty($trans_id_layanan)) {
			$this->db->where('trans_id_layanan =', $trans_id_layanan );	
		}

		if(!empty($trans_id_loket)) {
			$this->db->where('trans_id_loket =', $trans_id_loket );	
		}

		$vItems = array(
			'list_x'		=> array(),
			'list_y'		=> array(),
			'list_x_2'		=> array(),
			'periode'		=> $tgl_periode,
			'keterangan'	=> array(),
		);

		$vItems['listwarna'] = array(
			array(
				'rgba(255,0,0, 0.9)',
				'rgba(255,0,0, 0.9)',
				'rgba(255,0,0, 0.9)',
				'rgba(255,0,0, 0.9)',
			),
			array(
				'rgba(255,255,0, 0.9)',
				'rgba(255,255,0, 0.9)',
				'rgba(255,255,0, 0.9)',
				'rgba(255,255,0, 0.9)',
			),
			array(
				'rgba(0,255,0, 0.9)',
				'rgba(0,255,0, 0.9)',
				'rgba(0,255,0, 0.9)',
				'rgba(0,255,0, 0.9)',
			),
			array(
				'rgba(0,0,255, 0.9)',
				'rgba(0,0,255, 0.9)',
				'rgba(0,0,255, 0.9)',
				'rgba(0,0,255, 0.9)',
			),
		);

		$vItems['listwarnahex'] = array(
			'#ff0000',
			'#ffff00',
			'#00ff00',
			'#0000ff',
		);

		//hanya user yang dilayani
		$this->db->where('trans_waktu_ambil !=', '00:00:00' );
		$this->db->where('trans_id_loket !=', '' );
		//$this->db->where('a.id_user !=', '' );

		if($type_summary == 'summary_user') $grpx = 'admusr_username as info,';
		else if($type_summary == 'summary_loket') $grpx = 'lokets_name as info,';
		else if($type_summary == 'summary_layanan') $grpx = 'lay_nama_layanan as info,';
		else $grpx = 'trans_tanggal_transaksi as info,';

		$this->db->Select($grpx . ",trans_tanggal_transaksi, SEC_TO_TIME(AVG(TIME_TO_SEC(IF(TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ) > 0, TIMEDIFF(  trans_waktu_panggil,  trans_waktu_ambil ), 0)))) as rata_rata, DATE_FORMAT(trans_tanggal_transaksi, '%d-%m-%Y') as tgl_transaksi", FALSE);

		$this->db->join("layanan","trans_id_layanan = lay_id_layanan","Left");
		$this->db->join("group_layanan","trans_id_group_layanan = grolay_id_group_layanan","Left");
		$this->db->join("adminusers","trans_id_user = admusr_id","Left");
		$this->db->join("lokets AS e","trans_id_loket = lokets_id","Left");
		
		if($type_summary == 'summary_user') $this->db->order_by('admusr_username','ASC');
		else if($type_summary == 'summary_loket') $this->db->order_by('lokets_name','ASC');
		else if($type_summary == 'summary_layanan') $this->db->order_by('lay_nama_layanan','ASC');
		else $this->db->order_by('trans_tanggal_transaksi','ASC');
		
		$this->db->from("transaksi");

		if(!empty($trans_id_user)) {
			$this->db->group_by(array("trans_id_user", "trans_tanggal_transaksi"));
			//echo "string-x";
		} else if(!empty($trans_id_layanan)) {
			$this->db->group_by(array("trans_id_layanan", "trans_tanggal_transaksi"));
			//echo "string-y";
		} else if(!empty($trans_id_loket)) {
			$this->db->group_by(array("trans_id_loket", "trans_tanggal_transaksi"));
			//echo "string-z";
		} else {
			if($type_summary == 'summary_user') $this->db->group_by(array("trans_id_user"));
			else if($type_summary == 'summary_loket') $this->db->group_by(array("trans_id_loket"));
			else if($type_summary == 'summary_layanan') $this->db->group_by(array("trans_id_layanan"));
			else $this->db->group_by(array("trans_tanggal_transaksi"));

			//echo "string-a";
		}
		//exit();
		
		$vResult = $this->db->get()->result();
		//echo $this->db->last_query(); exit();

		foreach($vResult as $vRow):

			if(!empty($trans_id_user)) {
				$vItems['list_x'][] = "'$vRow->tgl_transaksi'";
				$vItems['list_x_2'][] = $vRow->tgl_transaksi;
				$vItems['keterangan'][] = $vRow->tgl_transaksi . ' (<span style="display: inline-block;width:10px;height:10px;line-height: 10px;background-color:'.$vItems['listwarnahex'][0].';">&nbsp;</span> '.$vRow->rata_rata.')';
				//echo "string-x";
			} else if(!empty($trans_id_loket)) {
				$vItems['list_x'][] = "'$vRow->tgl_transaksi'";
				$vItems['list_x_2'][] = $vRow->tgl_transaksi;
				$vItems['keterangan'][] = $vRow->tgl_transaksi . ' (<span style="display: inline-block;width:10px;height:10px;line-height: 10px;background-color:'.$vItems['listwarnahex'][0].';">&nbsp;</span> '.$vRow->rata_rata.')';
				//echo "string-y";
			} else if(!empty($trans_id_layanan)) {
				$vItems['list_x'][] = "'$vRow->tgl_transaksi'";
				$vItems['list_x_2'][] = $vRow->tgl_transaksi;
				$vItems['keterangan'][] = $vRow->tgl_transaksi . ' (<span style="display: inline-block;width:10px;height:10px;line-height: 10px;background-color:'.$vItems['listwarnahex'][0].';">&nbsp;</span> '.$vRow->rata_rata.')';
				//echo "string-z";
			} else {
				$vItems['list_x'][] = "'$vRow->info'";
				$vItems['list_x_2'][] = $vRow->info;
				$vItems['keterangan'][] = $vRow->info . ' (<span style="display: inline-block;width:10px;height:10px;line-height: 10px;background-color:'.$vItems['listwarnahex'][0].';">&nbsp;</span> '.$vRow->rata_rata.')';
				//echo "string-a";
			}
			
			$vItems['list_y'][] 	= $this->convert_minute($vRow->rata_rata);

			//exit();
           
		endforeach;

		return $vItems;
	}
	
}

?>