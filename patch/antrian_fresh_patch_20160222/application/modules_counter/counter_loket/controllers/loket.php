<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loket extends MY_Counter {
	private $_template 			= 'template_counter/main';
	private $_module_controller = 'counter_loket/loket/';
	private $_table_name 		= 'transaksi';
	private $_table_field_pref 	= 'trans_';
	private $_table_pk 			= 'trans_id_transaksi';
	private $_model_crud 		= 'transaksi_model';

	private $_page_title 		= 'Antrian : Counter Loket';
	private $_page_content_info	= array(
		'title' => 'Data Counter Loket',
		'desc' 	=> 'List counter loket',
	);

	function __construct(){
		parent::__construct();

		$cookieset = $this->input->cookie($this->_data['cookie_name'],true);
		if(empty($cookieset)) {
			redirect('counter_loketdestination/loketdestination');
			exit();
		}

		if(!$this->session->userdata('admin_id') OR (!in_array($this->session->userdata('admin_userlevel'), array(1, 2)))) {
			redirect('counter_login/login');
			exit();
		}
	}

	private function get_additional_field() {
		$additional_field = array(
			array(
				'field_name' 			=> 'grolay_nama_group_layanan',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'trans_no_ticket_awal',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'trans_no_ticket',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'prilay_id_group_loket',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'trans_id_group_layanan',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'trans_status_transaksi',
				'just_info' 			=> true,
			),
			array(
				'field_name' 			=> 'trans_tanggal_transaksi',
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
				'title_header_column' 	=> 'No Ticket',
				'field_name' 			=> 'CONCAT(trans_no_ticket_awal, "", trans_no_ticket) as ticket',
				'alias'					=> 'ticket',
				'no_order'				=> 1,
			),
			array(
				'title_header_column' 	=> 'Type',
				'field_name' 			=> 'grolay_nama_group_layanan',
				'no_order'				=> 2,
			),
			array(
				'title_header_column' 	=> 'Time In',
				'field_name' 			=> $this->_table_field_pref . 'waktu_ambil',
				'no_order'				=> 3,
			),
			array(
				'title_header_column' 	=> 'Action',
				'field_name' 			=> $this->_table_field_pref . 'id_transaksi',
				'result_format'			=> function( $d, $row ) {
			            return '<a onclick="fnNext('.$d.');return false;" href="#" class="btn btn-xs btn-success">NEXT <i class="glyph-icon icon-pencil-square-o"></i></a>';
			        },
			    'no_order'				=> 4,
			),
		);

		return $column_list;
	}

	private function get_show_column_skip() {
		$column_list = array(
			array(
				'title_header_column' 	=> 'No.',
				'field_name' 			=> $this->_table_field_pref . 'id_transaksi',
				'show_no_static' 		=> true,
				'no_order'				=> 0,
			),
			array(
				'title_header_column' 	=> 'No Ticket',
				'field_name' 			=> 'CONCAT(trans_no_ticket_awal, "", trans_no_ticket) as ticket',
				'alias'					=> 'ticket',
				'no_order'				=> 1,
			),
			array(
				'title_header_column' 	=> 'Type',
				'field_name' 			=> 'grolay_nama_group_layanan',
				'no_order'				=> 2,
			),
			array(
				'title_header_column' 	=> 'Time In',
				'field_name' 			=> $this->_table_field_pref . 'waktu_ambil',
				'no_order'				=> 3,
			),
			array(
				'title_header_column' 	=> 'Action',
				'field_name' 			=> $this->_table_field_pref . 'id_transaksi',
				'result_format'			=> function( $d, $row ) {
			            return '<a onclick="fnUndo('.$d.');return false;" href="#" class="btn btn-xs btn-success">UNDO <i class="glyph-icon icon-pencil-square-o"></i></a>';
			        },
			    'no_order'				=> 4,
			),
		);

		return $column_list;
	}

	private function get_show_column_finish() {
		$column_list = array(
			array(
				'title_header_column' 	=> 'No.',
				'field_name' 			=> $this->_table_field_pref . 'id_transaksi',
				'show_no_static' 		=> true,
				'no_order'				=> 0,
			),
			array(
				'title_header_column' 	=> 'No Ticket',
				'field_name' 			=> 'CONCAT(trans_no_ticket_awal, "", trans_no_ticket) as ticket',
				'alias'					=> 'ticket',
				'no_order'				=> 1,
			),
			array(
				'title_header_column' 	=> 'Type',
				'field_name' 			=> 'grolay_nama_group_layanan',
				'no_order'				=> 2,
			),
			array(
				'title_header_column' 	=> 'Time Call',
				'field_name' 			=> $this->_table_field_pref . 'waktu_panggil',
				'no_order'				=> 3,
			),
		);

		return $column_list;
	}
	
	function index() {
		$this->lists();
	}

	function lists() {
		$this->load->model('lokets_model','loketsx');
		$tmp = $this->loketsx->where(array('lokets_id' => $this->_data['cookie_loket_id']))->get_row();
		$this->_data['loket_name'] = $tmp['lokets_name'];

		$this->load->model('adminuser_model','adminuserx');
		$tmp2 = $this->adminuserx->where(array('admusr_id' => $this->session->userdata('admin_id')))->get_login_userlevel();
		$this->_data['login_name'] = $tmp2['admusr_username'] . ' (' . $tmp['lokets_type'] . ')';

		$this->load->model('layanans_model','layanansx');
		$this->_data['layanan_forward'] = $this->layanansx->get_layanancounter();

		$this->_data['ajax_lists'] 			= site_url($this->_module_controller . 'lists_ajax');
		$this->_data['ajax_lists_skip'] 	= site_url($this->_module_controller . 'lists_ajax_skip');
		$this->_data['ajax_lists_finish'] 	= site_url($this->_module_controller . 'lists_ajax_finish');

		$this->_data['fnGoToNext'] 	= site_url($this->_module_controller . 'fnGoToNext');
		$this->_data['fnFinish'] 	= site_url($this->_module_controller . 'fnFinish');
		$this->_data['fnForward'] 	= site_url($this->_module_controller . 'fnForward');
		$this->_data['fnNext'] 		= site_url($this->_module_controller . 'fnNext');
		$this->_data['fnRecall'] 	= site_url($this->_module_controller . 'fnRecall');
		$this->_data['fnSkip'] 		= site_url($this->_module_controller . 'fnSkip');
		$this->_data['fnUndo'] 		= site_url($this->_module_controller . 'fnUndo');

		$this->_data['column_list'] = $this->get_show_column();
		$this->_data['column_list'] 		= $this->get_show_column();
		$this->_data['column_list_skip'] 	= $this->get_show_column_skip();
		$this->_data['column_list_finish'] 	= $this->get_show_column_finish();

		$this->_data['info_page'] = $this->_page_content_info;

		$this->_data['blank_image'] 	= site_url('assets/blank_user.jpg');
		$this->_data['sample_image'] 	= site_url('assets/sample.jpg');

		//using lib template
		$this->template->set('title', $this->_page_title);
		$this->template->set('loket_name', $this->_data['loket_name']);
		$this->template->set('login_name', $this->_data['login_name']);
		$this->template->set('assets', $this->_data['assets']);
		$this->template->set('url_logout', $this->_data['url_logout']);
		$this->template->set('layanan_forward', $this->_data['layanan_forward']);
		$this->template->set('sample_image', $this->_data['sample_image']);
		$this->template->load($this->_template, 'lists', $this->_data);
	}

	function page_content_ajax() {
		$this->_data['page_content_ajax'] 	= site_url($this->_module_controller . 'page_content_ajax');
		$this->_data['ajax_lists'] 			= site_url($this->_module_controller . 'lists_ajax');
		$this->_data['ajax_lists_skip'] 	= site_url($this->_module_controller . 'lists_ajax_skip');
		$this->_data['ajax_lists_finish'] 	= site_url($this->_module_controller . 'lists_ajax_finish');

		$this->_data['column_list'] 		= $this->get_show_column();
		$this->_data['column_list_skip'] 	= $this->get_show_column_skip();
		$this->_data['column_list_finish'] 	= $this->get_show_column_finish();

		$this->_data['info_page'] = $this->_page_content_info;

		$this->_data['blank_image'] 	= site_url('assets/blank_user.jpg');
		$this->_data['sample_image'] 	= site_url('assets/sample.jpg');

		$this->load->view('lists', $this->_data);
	}

	//--- used by datatable source data -------
	function lists_ajax() {
		$this->load->helper('mydatatable');
		$table 		= $this->db->dbprefix . $this->_table_name;
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'group_layanan ON (trans_id_group_layanan = grolay_id_group_layanan) ';
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'prioritas_layanan ON (trans_id_group_layanan = prilay_id_group_layanan) ';
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
				'ignore_search' 	=> !empty($value['ignore_search']) ? $value['ignore_search'] : '',
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
					'ignore_search' 	=> !empty($value['ignore_search']) ? $value['ignore_search'] : '',
				);
				$cnt++;
			}
		}

		$Loket 			= $this->_data['cookie_loket_id'];

		$currentDate 	= date('Ymd');
		$q 				= 'SELECT prilay_id_group_layanan, prilay_id_group_loket 
		FROM anf_lokets JOIN anf_prioritas_layanan ON (lokets_grolok_id = prilay_id_group_loket) 
		WHERE lokets_id = ' . $Loket;

		$query 			= $this->db->query($q);
		$listlayanan 	= array();
		$grouploket 	= '';
		foreach ($query->result() as $vRow)
		{
		   $listlayanan[] 	= $vRow->prilay_id_group_layanan;
		   $grouploket 		= $vRow->prilay_id_group_loket;
		}

		$whereResult 	= '';
		$whereAll 		= 'prilay_id_group_loket = ('.$grouploket.') AND trans_id_group_layanan IN ('.join(',', $listlayanan).') AND trans_status_transaksi = 0 AND trans_tanggal_transaksi = "'.$currentDate.'"';
		generateDataTable($table, $primaryKey, $columns, $whereResult, $whereAll);
	}

	function lists_ajax_skip() {
		$this->load->helper('mydatatable');
		$table 		= $this->db->dbprefix . $this->_table_name;
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'group_layanan ON (trans_id_group_layanan = grolay_id_group_layanan) ';
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'prioritas_layanan ON (trans_id_group_layanan = prilay_id_group_layanan) ';
		$primaryKey = $this->_table_pk;
		$column_list = $this->get_show_column_skip();
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

		$Loket 			= $this->_data['cookie_loket_id'];

		$currentDate 	= date('Ymd');
		$q 				= 'SELECT prilay_id_group_layanan, prilay_id_group_loket 
		FROM anf_lokets JOIN anf_prioritas_layanan ON (lokets_grolok_id = prilay_id_group_loket) 
		WHERE lokets_id = ' . $Loket;

		$query 			= $this->db->query($q);
		$listlayanan 	= array();
		$grouploket 	= '';
		foreach ($query->result() as $vRow)
		{
		   $listlayanan[] 	= $vRow->prilay_id_group_layanan;
		   $grouploket 		= $vRow->prilay_id_group_loket;
		}

		$whereResult 	= '';
		$whereAll 		= 'prilay_id_group_loket = ('.$grouploket.') AND trans_id_group_layanan IN ('.join(',', $listlayanan).') AND trans_status_transaksi = 3 AND trans_tanggal_transaksi = "'.$currentDate.'"';
		generateDataTable($table, $primaryKey, $columns, $whereResult, $whereAll);
	}

	function lists_ajax_finish() {
		$this->load->helper('mydatatable');
		$table 		= $this->db->dbprefix . $this->_table_name;
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'group_layanan ON (trans_id_group_layanan = grolay_id_group_layanan) ';
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'prioritas_layanan ON (trans_id_group_layanan = prilay_id_group_layanan) ';
		$primaryKey = $this->_table_pk;
		$column_list = $this->get_show_column_finish();
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

		$Loket 			= $this->_data['cookie_loket_id'];

		$currentDate 	= date('Ymd');
		$q 				= 'SELECT prilay_id_group_layanan, prilay_id_group_loket 
		FROM anf_lokets JOIN anf_prioritas_layanan ON (lokets_grolok_id = prilay_id_group_loket) 
		WHERE lokets_id = ' . $Loket;

		$query 			= $this->db->query($q);
		$listlayanan 	= array();
		$grouploket 	= '';
		foreach ($query->result() as $vRow)
		{
		   $listlayanan[] 	= $vRow->prilay_id_group_layanan;
		   $grouploket 		= $vRow->prilay_id_group_loket;
		}

		$whereResult 	= '';
		$whereAll 		= 'prilay_id_group_loket = ('.$grouploket.') AND trans_id_group_layanan IN ('.join(',', $listlayanan).') AND trans_status_transaksi = 5 AND trans_tanggal_transaksi = "'.$currentDate.'"';
		generateDataTable($table, $primaryKey, $columns, $whereResult, $whereAll);
	}

	function fnGoToNext($ticket_number = '') {
		$ticket_number = $this->input->post('ticket_number');

		$lenticketnumber 		= strlen($ticket_number);
		$trans_no_ticket_awal 	= strtoupper(substr($ticket_number, 0, 1));
		$trans_no_ticket 		= substr($ticket_number, 1, $lenticketnumber);

		$vArrayTemp = array(
			'trans_id_transaksi' 	=> '',
			'no_tiket' 				=> '',
			'transaction' 			=> '',
			'start' 				=> '',
			'sRegVisitor' 			=> '',
			'layanan_forward' 		=> '',
			'id_group_layanan' 		=> '',
		);

		$trans_tanggal_transaksi 	= date('Ymd');
		$trans_waktu_panggil 		= date("H:i:s");
		$waktu_finish 				= $trans_waktu_panggil;

		$Loket 			= $this->_data['cookie_loket_id'];	

		$q = 'SELECT prilay_id_group_layanan 
		FROM anf_lokets 
		JOIN anf_prioritas_layanan ON (lokets_grolok_id = prilay_id_group_loket) 
		WHERE lokets_id = ' . $Loket;

		$query = $this->db->query($q);
		$listlayanan = array();
		foreach ($query->result() as $vRow)
		{
		   $listlayanan[] = $vRow->prilay_id_group_layanan;
		}

		$cal_next=$this->db->query("SELECT trans_nama_file,trans_id_transaksi,trans_no_ticket,lay_nama_layanan,trans_waktu_ambil, lay_id_group_layanan, lay_id_layanan_forward, lay_estimasi 
			FROM anf_transaksi 
			LEFT JOIN anf_layanan ON trans_id_layanan = lay_id_layanan 
			JOIN anf_prioritas_layanan ON (trans_id_group_layanan = prilay_id_group_layanan) 
			where trans_status_transaksi = '0' and trans_id_group_layanan IN (".join(',', $listlayanan).") and trans_tanggal_transaksi='$trans_tanggal_transaksi' and trans_no_ticket_awal = '$trans_no_ticket_awal' and trans_no_ticket = '$trans_no_ticket' 
			order by prilay_prioritas ASC, trans_id_transaksi asc LIMIT 1");

		$vRow_next = $cal_next->row_array(); 

		if(!empty($vRow_next['trans_id_transaksi'])) {

			$trans_id_transaksi 	= $vRow_next['trans_id_transaksi'];
			$next_id 				= $vRow_next['trans_no_ticket'];	
			$transaction 			= $vRow_next['lay_nama_layanan'];
			$trans_waktu_ambil 		= $vRow_next['trans_waktu_ambil'];
			$lay_id_layanan_forward = $vRow_next['lay_id_layanan_forward'];
			$estimasi 				= $vRow_next['lay_estimasi'];
			$nama_file 				= $vRow_next['trans_nama_file'];

			$ct_id_lay=$this->db->query("SELECT trans_tanggal_transaksi,trans_no_ticket_awal,trans_no_ticket,grolay_nama_group_layanan,trans_waktu_panggil,trans_id_layanan,trans_id_group_layanan 
				from anf_transaksi 
				join anf_group_layanan ON trans_id_group_layanan=grolay_id_group_layanan 
				where trans_status_transaksi IN (1,2) and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi' 
				order by trans_id_transaksi desc ");
			$_countmk3 = $ct_id_lay->row_array(); 

			$q = 'SELECT * FROM anf_layanan';
			$query = $this->db->query($q);
			$daftarlayanan = array();
			foreach ($query->result() as $vRow)
			{
			   $daftarlayanan[$vRow->lay_id_layanan] = (array) $vRow;
			}

			$vArrayTemp['trans_id_transaksi'] = $trans_id_transaksi;
			$vArrayTemp['no_tiket'] = $next_id;		           			
			$vArrayTemp['transaction'] = $transaction;		           			
			$vArrayTemp['start'] = $trans_waktu_ambil;		           						
			$vArrayTemp['sRegVisitor'] = $this->session->userdata('sRegVisitor');
			$vArrayTemp['layanan_forward'] = !empty($daftarlayanan[$lay_id_layanan_forward]) ? $daftarlayanan[$lay_id_layanan_forward]['lay_nama_layanan'] : '';
			$vArrayTemp['id_group_layanan'] = $daftarlayanan[$daftarlayanan[$lay_id_layanan_forward]['lay_id_layanan_forward']]['lay_id_group_layanan'];

			$vArrayTemp['nama_file'] = $nama_file;
			$vArrayTemp['estimasi'] = $estimasi;

			$sql=$this->db->query("UPDATE anf_transaksi 
				set trans_status_transaksi='1',trans_waktu_panggil='$trans_waktu_panggil',trans_id_loket='$Loket' 
				where trans_no_ticket='$next_id' and trans_id_group_layanan IN (".join(',', $listlayanan).") and trans_tanggal_transaksi='$trans_tanggal_transaksi'");

			if ($_countmk3['trans_tanggal_transaksi'] > '0')
			{
				$sql=$this->db->query("UPDATE anf_transaksi 
					set trans_waktu_finish='$waktu_finish', trans_status_transaksi='5', trans_id_user='".$this->session->userdata('admin_id')."' 
					where trans_no_ticket='$_countmk3[trans_no_ticket]' and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi' ");

				$lay_id_layanan_forward = $daftarlayanan[$_countmk3['trans_id_layanan']]['lay_id_layanan_forward'];

				  if(!empty($lay_id_layanan_forward)) {
				  	$vItems = array(
						'trans_tanggal_transaksi' 	=> $trans_tanggal_transaksi,
						'trans_waktu_ambil' 		=> $trans_waktu_panggil,
						'trans_no_ticket_awal' 		=> $_countmk3['trans_no_ticket_awal'],
						'trans_no_ticket' 			=> $_countmk3['trans_no_ticket'],
						'id_layanan' 				=> $lay_id_layanan_forward,
						'id_group_layanan' 			=> $daftarlayanan[$lay_id_layanan_forward]['lay_id_group_layanan'],
					);

					$sql=$this->db->query("INSERT INTO anf_transaksi (trans_tanggal_transaksi,trans_waktu_ambil,trans_no_ticket_awal,trans_no_ticket,trans_id_layanan,trans_id_group_layanan) 
				  VALUES ('$vItems[trans_tanggal_transaksi]', '$vItems[trans_waktu_ambil]','$vItems[trans_no_ticket_awal]', '$vItems[trans_no_ticket]','$vItems[id_layanan]','$vItems[id_group_layanan]')");
				  }
			}
		}
		echo json_encode($vArrayTemp);
	}

	function fnFinish() {
		$result = array(
			'success' 	=> true,
		);

		$trans_tanggal_transaksi=date('Ymd');
		$trans_waktu_panggil=date("H:i:s");
		$waktu_finish=$trans_waktu_panggil;

		$Loket= $this->_data['cookie_loket_id'];

		$ct_id_lay=$this->db->query("SELECT trans_tanggal_transaksi,trans_no_ticket_awal,trans_no_ticket,grolay_nama_group_layanan,trans_waktu_panggil,trans_id_layanan,trans_id_group_layanan 
			from anf_transaksi 
			JOIN anf_group_layanan ON trans_id_group_layanan=grolay_id_group_layanan 
			where trans_status_transaksi IN (1,2) and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi' 
			order by trans_id_transaksi desc ");

		$_countmk3 = $ct_id_lay->row_array(); 

		if ($_countmk3['trans_tanggal_transaksi'] > '0')
		{
		  $sql=$this->db->query("UPDATE anf_transaksi 
		  	set trans_waktu_finish='$waktu_finish', trans_status_transaksi='5', trans_id_user='".$this->session->userdata('admin_id')."' 
		  	where trans_no_ticket='$_countmk3[trans_no_ticket]' and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi' ");

		  	$q = 'SELECT * FROM anf_layanan';
			$query = $this->db->query($q);
			$daftarlayanan = array();
			foreach ($query->result() as $vRow)
			{
			   $daftarlayanan[$vRow->lay_id_layanan] = (array) $vRow;
			}

			$lay_id_layanan_forward = $daftarlayanan[$_countmk3['trans_id_layanan']]['lay_id_layanan_forward'];

			if(!empty($lay_id_layanan_forward)) {
				$vItems = array(
					'trans_tanggal_transaksi' 	=> $trans_tanggal_transaksi,
					'trans_waktu_ambil' 		=> $trans_waktu_panggil,
					'trans_no_ticket_awal' 		=> $_countmk3['trans_no_ticket_awal'],
					'trans_no_ticket' 			=> $_countmk3['trans_no_ticket'],
					'id_layanan' 				=> $lay_id_layanan_forward,
					'id_group_layanan' 			=> $daftarlayanan[$lay_id_layanan_forward]['lay_id_group_layanan'],
				);

				$sql=$this->db->query("INSERT INTO anf_transaksi (trans_tanggal_transaksi,trans_waktu_ambil,trans_no_ticket_awal,trans_no_ticket,trans_id_layanan,trans_id_group_layanan) 
				VALUES ('$vItems[trans_tanggal_transaksi]', '$vItems[trans_waktu_ambil]','$vItems[trans_no_ticket_awal]', '$vItems[trans_no_ticket]','$vItems[id_layanan]','$vItems[id_group_layanan]')");
			}
		}
		echo json_encode($result);
	}
	
	function fnNext($trans_id_transaksi = '') {
		$trans_id_transaksi = $this->input->post('id');

		$trans_tanggal_transaksi 	= date('Ymd');
		$trans_waktu_panggil 		= date("H:i:s");
		$waktu_finish 				= $trans_waktu_panggil;

		$Loket 			= $this->_data['cookie_loket_id'];

		$q = 'SELECT prilay_id_group_layanan, prilay_id_group_loket 
		FROM anf_lokets 
		JOIN anf_prioritas_layanan ON (lokets_grolok_id = prilay_id_group_loket) 
		WHERE lokets_id = ' . $Loket;

		$query = $this->db->query($q);
		$listlayanan 	= array();
		$grouploket 	= '';
		foreach ($query->result() as $vRow)
		{
		   $listlayanan[] = $vRow->prilay_id_group_layanan;
		   $grouploket = $vRow->prilay_id_group_loket;
		}

		$addWhere = !empty($trans_id_transaksi) ? ('trans_id_transaksi = "'.$trans_id_transaksi.'" AND ') : '';

		$cal_next=$this->db->query('SELECT trans_nama_file,trans_id_transaksi,trans_no_ticket,lay_nama_layanan,trans_waktu_ambil, lay_id_group_layanan, lay_id_layanan_forward, lay_estimasi 
			FROM anf_transaksi 
			LEFT JOIN anf_layanan ON trans_id_layanan=lay_id_layanan 
			JOIN anf_prioritas_layanan ON (trans_id_group_layanan = prilay_id_group_layanan) 
			WHERE '.$addWhere.' prilay_id_group_loket = ('.$grouploket.') AND trans_id_group_layanan IN ('.join(',', $listlayanan).') AND trans_status_transaksi = 0 AND trans_tanggal_transaksi = "'.$trans_tanggal_transaksi.'" 
			ORDER BY prilay_prioritas ASC, trans_id_transaksi LIMIT 1');

		$vRow_next 					= $cal_next->row_array(); 
		$trans_id_transaksi 		= $vRow_next['trans_id_transaksi'];
		$next_id 					= $vRow_next['trans_no_ticket'];	
		$transaction 				= $vRow_next['lay_nama_layanan'];
		$trans_waktu_ambil 			= $vRow_next['trans_waktu_ambil'];
		$lay_id_layanan_forward 	= $vRow_next['lay_id_layanan_forward'];
		$estimasi 					= $vRow_next['lay_estimasi'];
		$nama_file 					= $vRow_next['trans_nama_file'];

		$ct_id_lay=$this->db->query("SELECT trans_tanggal_transaksi,trans_no_ticket_awal,trans_no_ticket,grolay_nama_group_layanan,trans_waktu_panggil,trans_id_layanan,trans_id_group_layanan from anf_transaksi 
			JOIN anf_group_layanan ON trans_id_group_layanan=grolay_id_group_layanan 
			where trans_status_transaksi IN (1,2) and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi' 
			order by trans_id_transaksi desc ");

		$_countmk3 = $ct_id_lay->row_array(); 

		$ct_id_skip=$this->db->query("SELECT trans_id_transaksi 
			from anf_transaksi where trans_status_transaksi='2' and trans_tanggal_transaksi='$trans_tanggal_transaksi' 
			order by trans_id_transaksi asc ");

		$id_skip = $ct_id_skip->row_array(); 
		$skip_id=$id_skip['trans_id_transaksi'];

		
	    //cek Layanan Forward-------------------------------------------
	    $data_fwd=$this->db->query("SELECT lay_id_group_layanan,lay_id_layanan_forward 
	    	from anf_layanan 
	    	where lay_id_layanan='$_countmk3[trans_id_layanan]'");

		$data_fw = $data_fwd->row_array(); 

		
	    $sql_cek_fw_group=$this->db->query("SELECT lay_id_group_layanan 
	    	from anf_layanan 
	    	where lay_id_layanan='$data_fw[lay_id_layanan_forward]'");

		$data_fw_group = $sql_cek_fw_group->row_array(); 

		$q = 'SELECT * FROM anf_layanan';
		$query = $this->db->query($q);
		$daftarlayanan = array();
		foreach ($query->result() as $vRow)
		{
		   $daftarlayanan[$vRow->lay_id_layanan] = (array) $vRow;
		}


		$vArrayTemp['trans_id_transaksi'] = $trans_id_transaksi;		           			

		$vArrayTemp['no_tiket'] = $next_id;		           			
		$vArrayTemp['transaction'] = $transaction;		           			
		$vArrayTemp['start'] = $trans_waktu_ambil;		           						
		$vArrayTemp['sRegVisitor'] = $this->session->userdata('sRegVisitor');
		$vArrayTemp['layanan_forward'] = !empty($daftarlayanan[$lay_id_layanan_forward]) ? $daftarlayanan[$lay_id_layanan_forward]['lay_nama_layanan'] : '';
		$vArrayTemp['id_group_layanan'] = $daftarlayanan[$daftarlayanan[$lay_id_layanan_forward]['lay_id_layanan_forward']]['lay_id_group_layanan'];

		$vArrayTemp['nama_file'] = $nama_file;
		$vArrayTemp['estimasi'] = $estimasi;

		echo json_encode($vArrayTemp);

		$sql=$this->db->query("UPDATE anf_transaksi 
		  	set  trans_status_transaksi='1',trans_waktu_panggil='$trans_waktu_panggil',trans_id_loket='$Loket', trans_id_user='".$this->session->userdata('admin_id')."' 
		  	where trans_no_ticket='$next_id' and trans_id_group_layanan IN (".join(',', $listlayanan).") and trans_tanggal_transaksi='$trans_tanggal_transaksi'");

		if ($_countmk3['trans_tanggal_transaksi'] > '0')
		{
		  $sql=$this->db->query("UPDATE anf_transaksi 
		  	set trans_waktu_finish='$waktu_finish', trans_status_transaksi='5' 
		  	where trans_no_ticket='$_countmk3[trans_no_ticket]' and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi' ");

		  $lay_id_layanan_forward = $daftarlayanan[$_countmk3['trans_id_layanan']]['lay_id_layanan_forward'];

		  if(!empty($lay_id_layanan_forward)) {
		  	$vItems = array(
				'trans_tanggal_transaksi' 	=> $trans_tanggal_transaksi,
				'trans_waktu_ambil' 		=> $trans_waktu_panggil,
				'trans_no_ticket_awal' 		=> $_countmk3['trans_no_ticket_awal'],
				'trans_no_ticket' 			=> $_countmk3['trans_no_ticket'],
				'id_layanan' 				=> $lay_id_layanan_forward,
				'id_group_layanan' 			=> $daftarlayanan[$lay_id_layanan_forward]['lay_id_group_layanan'],
			);

			$sql=$this->db->query("INSERT INTO anf_transaksi (trans_tanggal_transaksi,trans_waktu_ambil,trans_no_ticket_awal,trans_no_ticket,trans_id_layanan,trans_id_group_layanan) 
		  VALUES ('$vItems[trans_tanggal_transaksi]', '$vItems[trans_waktu_ambil]','$vItems[trans_no_ticket_awal]', '$vItems[trans_no_ticket]','$vItems[id_layanan]','$vItems[id_group_layanan]')");
		  }
		}
		else{
		//close cek layanan forward------------------------------------------------------------------------------
	    }
	
	}

	function fnSkip() {
		$result = array(
			'success' 	=> true,
		);

		$trans_tanggal_transaksi 	= date('Ymd');
		$trans_waktu_panggil 		= date("H:i:s");

		$Loket 			= $this->_data['cookie_loket_id'];

		$ct_id_lay = $this->db->query("SELECT trans_tanggal_transaksi,trans_no_ticket,grolay_nama_group_layanan,trans_waktu_panggil,trans_id_layanan,trans_id_group_layanan 
			from anf_transaksi JOIN anf_group_layanan ON trans_id_group_layanan=grolay_id_group_layanan 
			where trans_status_transaksi IN (1,2) and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi' 
			order by trans_id_transaksi desc ");
		$_countmk3 = $ct_id_lay->row_array(); 
		
		$sql=$this->db->query("UPDATE anf_transaksi 
			set  trans_status_transaksi='3' 
			where trans_no_ticket='$_countmk3[trans_no_ticket]' and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi'");

		echo json_encode($result);
	}
	
	function fnUndo($trans_id_transaksi = '') {
		$trans_id_transaksi = $this->input->post('id');

		$result = array(
			'success' 	=> true,
		);

	  	$sql=$this->db->query("UPDATE anf_transaksi 
	  	set  trans_status_transaksi='0', trans_id_loket='' 
	  	where trans_id_transaksi = '$trans_id_transaksi' ");

	  	echo json_encode($result);
	}

	function fnforward($id_layanan, $id_group_layanan) {
		$id_layanan 		= $this->input->post('id_layanan');
		$id_group_layanan 	= $this->input->post('id_group_layanan');

		$result = array(
			'success' 	=> true,
		);

		$Loket 				= $this->_data['cookie_loket_id'];

		$tmp 				= date('Ymd H:i:s');
		$tmpdate 			= explode(' ', $tmp);
		$currentDate 		= $tmpdate[0];
		$currentTime 		= $tmpdate[1];
		$waktu_finish 		= $tmpdate[1];

		$vItems = array(
			'trans_tanggal_transaksi' 	=> $currentDate,
			'trans_waktu_ambil' 		=> $currentTime,
			'trans_no_ticket_awal' 		=> '',
			'trans_no_ticket' 			=> '',
			'id_layanan' 				=> $id_layanan,
			'id_group_layanan' 			=> $id_group_layanan,
		);

		$q = 'SELECT prilay_id_group_layanan, prilay_id_group_loket 
		FROM anf_lokets JOIN anf_prioritas_layanan ON (lokets_grolok_id = prilay_id_group_loket) 
		WHERE lokets_id = ' . $Loket;

		$query = $this->db->query($q);
		$listlayanan = array();
		$grouploket = '';
		foreach ($query->result() as $vRow)
		{
		   $listlayanan[] = $vRow->prilay_id_group_layanan;
		   $grouploket = $vRow->prilay_id_group_loket;
		}

		$q = 'SELECT grolay_nama_group_layanan, trans_id_transaksi, trans_no_ticket, trans_waktu_ambil, trans_no_ticket_awal, trans_id_layanan, trans_id_group_layanan 
		FROM anf_transaksi JOIN anf_group_layanan ON (trans_id_group_layanan = grolay_id_group_layanan) 
		JOIN anf_prioritas_layanan ON (trans_id_group_layanan = prilay_id_group_layanan) 
		WHERE prilay_id_group_loket = ('.$grouploket.') AND trans_id_group_layanan IN ('.join(',', $listlayanan).') AND trans_status_transaksi IN (1,2) AND trans_tanggal_transaksi = "'.$currentDate.'" 
		ORDER BY prilay_prioritas ASC, trans_id_transaksi LIMIT 1';

		$query = $this->db->query($q);

		$trans_id_transaksi = '';
		foreach ($query->result() as $vRow)
		{
			$trans_id_transaksi 				= $vRow->trans_id_transaksi;
		   	$vItems['trans_no_ticket_awal'] 	= $vRow->trans_no_ticket_awal;
		   	$vItems['trans_no_ticket'] 		= $vRow->trans_no_ticket;
		}

		$sql=$this->db->query("UPDATE anf_transaksi 
			set trans_waktu_finish='$waktu_finish', trans_status_transaksi='5', trans_id_user='".$this->session->userdata('admin_id')."', trans_id_loket = ".$Loket." where trans_id_transaksi=".$trans_id_transaksi);

		$sql=$this->db->query("INSERT INTO anf_transaksi (trans_tanggal_transaksi,trans_waktu_ambil,trans_no_ticket_awal,trans_no_ticket,trans_id_layanan,trans_id_group_layanan) 
	  VALUES ('$vItems[trans_tanggal_transaksi]', '$vItems[trans_waktu_ambil]','$vItems[trans_no_ticket_awal]', '$vItems[trans_no_ticket]','$vItems[id_layanan]','$vItems[id_group_layanan]')");

		echo json_encode($result);
	}

	function fnRecall() {
		$result = array(
			'success' 	=> true,
		);

		$trans_tanggal_transaksi 	= date('Ymd');
		$trans_waktu_panggil 		= date("H:i:s");

		$Loket 			= $this->_data['cookie_loket_id'];

		$ct_id_lay = $this->db->query("SELECT trans_tanggal_transaksi,trans_no_ticket,grolay_nama_group_layanan,trans_waktu_panggil,trans_id_layanan,trans_id_group_layanan 
			from anf_transaksi JOIN anf_group_layanan ON trans_id_group_layanan=grolay_id_group_layanan 
			where trans_status_transaksi IN (1,2) and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi' 
			order by trans_id_transaksi desc ");
		$_countmk3 = $ct_id_lay->row_array(); 
		
		$sql=$this->db->query("UPDATE anf_transaksi 
			set  trans_status_transaksi='1' 
			where trans_no_ticket='$_countmk3[trans_no_ticket]' and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi'");

		echo json_encode($result);
		
	}
	
}

?>