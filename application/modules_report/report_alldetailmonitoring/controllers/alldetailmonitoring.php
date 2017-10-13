<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alldetailmonitoring extends MY_Admin {
	private $_template 			= 'template_admin/main';
	private $_module_controller = 'report_alldetailmonitoring/alldetailmonitoring/';
	private $_table_name 		= 'transaksi';
	private $_table_field_pref 	= 'trans_';
	private $_table_pk 			= 'trans_id_transaksi';
	private $_model_crud 		= 'reportalldetail_model';

	private $_page_title 		= 'Antrian : Admin Laporan All Detail Monitoring';
	private $_page_content_info	= array(
		'title' => 'Data Admin Laporan All Detail Monitoring',
		'desc' 	=> 'List laporan all detail monitoring',
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
				'field_name' 			=> 'lay_nama_layanan',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'trans_no_ticket_awal',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'lokets_name',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'trans_id_loket',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'trans_id_layanan',
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
				'title_header_column' 	=> 'Nama Loket',
				'field_name' 			=> 'lokets_name',
				'no_order'				=> 1,
			),
			array(
				'title_header_column' 	=> 'Nama Layanan',
				'field_name' 			=> 'lay_nama_layanan',
				'no_order'				=> 2,
			),
			array(
				'title_header_column' 	=> 'Tanggal Transaksi',
				'field_name' 			=> 'DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal',
				'alias'					=> 'own_tanggal',
				'no_order'				=> 3,
			),
			array(
				'title_header_column' 	=> 'No Ticket',
				'field_name' 			=> 'CONCAT(trans_no_ticket_awal, "", trans_no_ticket) as no_ticket',
				'alias'					=> 'no_ticket',
				'no_order'				=> 4,
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
		$this->_data['ajax_lists'] 	= site_url($this->_module_controller . 'lists_ajax');
		$this->_data['column_list'] = $this->get_show_column();

		$this->_data['trans_id_layanan'] 		= $this->input->post('trans_id_layanan');
		$this->_data['trans_id_loket'] 			= $this->input->post('trans_id_loket');
		$this->_data['trans_id_user'] 			= $this->input->post('trans_id_user');
		//$this->_data['trans_tanggal_transaksi'] = $this->input->post('trans_tanggal_transaksi');
        $dateNow = date('Y-m-d');
        $this->_data['trans_tanggal_transaksi'] = "$dateNow - $dateNow";
		$this->load->view('lists_filter', $this->_data);
	}

	//--- used by datatable source data -------
	function lists_ajax() {
		$this->load->helper('mydatatable');
		$table 		= $this->db->dbprefix . $this->_table_name;
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'layanan ON (trans_id_layanan = lay_id_layanan) ';
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'group_layanan ON (trans_id_group_layanan = grolay_id_group_layanan) ';
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'lokets ON (trans_id_loket = lokets_id) ';
		$primaryKey = $this->_table_pk;
		$column_list = $this->get_show_column();
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

		generateDataTable($table, $primaryKey, $columns);
	}

	function page_export_text() {
		if(!empty($_GET['periode'])) {
			$periode = explode('_', $_GET['periode']);

			$date_start = !empty($periode[0]) ? $periode[0] : '';
			$date_end = !empty($periode[1]) ? $periode[1] : '';

			if(!empty($date_start) AND !empty($date_end)) {
				$this->db->where('DATE_FORMAT(trans_tanggal_transaksi, "%Y-%m-%d") BETWEEN "'.$date_start.'" AND "'.$date_end.'"');
			}
		}

		$this->db->select('lokets_name, lay_nama_layanan, DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal, CONCAT(trans_no_ticket_awal, "", trans_no_ticket) as no_ticket', false);
		$this->db->from($this->_table_name);
		$this->db->join('layanan', 'trans_id_layanan = lay_id_layanan', 'left');
		$this->db->join('group_layanan', 'trans_id_group_layanan = grolay_id_group_layanan', 'left');
		$this->db->join('lokets', 'trans_id_loket = lokets_id', 'left');
		$this->db->order_by('own_tanggal', 'ASC');
		$this->_data['data_master'] = $this->db->get()->result_array();
		//print_r($this->_data['data_master']);

		$this->template->set('title', 'Antrian : Export Text All Detail');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_export/export_text', 'lists_exporttext', $this->_data);
	}

	function page_export_excel() {
		$filename = 'antrian_alldetail_' . str_replace('-', '', date('Y-m-d')) . '.xls';
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename = " . $filename);
		header("Pragma: no-cache");
		header("Expires: 0");

		if(!empty($_GET['periode'])) {
			$periode = explode('_', $_GET['periode']);

			$date_start = !empty($periode[0]) ? $periode[0] : '';
			$date_end = !empty($periode[1]) ? $periode[1] : '';

			if(!empty($date_start) AND !empty($date_end)) {
				$this->db->where('DATE_FORMAT(trans_tanggal_transaksi, "%Y-%m-%d") BETWEEN "'.$date_start.'" AND "'.$date_end.'"');
			}
		}

		$this->db->select('lokets_name, lay_nama_layanan, DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal, CONCAT(trans_no_ticket_awal, "", trans_no_ticket) as no_ticket', false);
		$this->db->from($this->_table_name);
		$this->db->join('layanan', 'trans_id_layanan = lay_id_layanan', 'left');
		$this->db->join('group_layanan', 'trans_id_group_layanan = grolay_id_group_layanan', 'left');
		$this->db->join('lokets', 'trans_id_loket = lokets_id', 'left');
		$this->db->order_by('own_tanggal', 'ASC');
		$this->_data['data_master'] = $this->db->get()->result_array();

		$this->template->set('title', 'Antrian : Export Excel All Detail');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_export/export_excel', 'lists_exportexcel', $this->_data);
	}
	
}

?>