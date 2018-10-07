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
            array(
                'field_name' 			=> 'admusr_username',
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
                'title_header_column' 	=> 'Tanggal Transaksi',
                'field_name' 			=> 'DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal',
                'alias'					=> 'own_tanggal',
                'no_order'				=> 2,
            ),
            array(
                'title_header_column' 	=> 'No Ticket',
                'field_name' 			=> 'CONCAT(trans_no_ticket_awal, "", trans_no_ticket) as no_ticket',
                'alias'					=> 'no_ticket',
                'no_order'				=> 3,
            ),
            array(
                'title_header_column' 	=> 'Waktu Ambil',
                'field_name' 			=> 'trans_waktu_ambil',
                'no_order'				=> 4,
            ),
            array(
                'title_header_column' 	=> 'Waktu Tunggu',
                'field_name' 			=> '1 as waktu_tunggu',
                'alias'					=> 'waktu_tunggu',
                'no_order'				=> 5,
                'result_format'			=> function( $d, $row ) {
                    $waktu_tunggu = '-';
                    if(!empty($row['trans_waktu_panggil']) AND $row['trans_waktu_ambil'] != '00:00:00' AND $row['trans_waktu_panggil'] != '00:00:00') {
                        $time1 = strtotime($row['trans_waktu_ambil']);
                        $time2 = strtotime($row['trans_waktu_panggil']);
                        $diff = $time2 - $time1;
                        $waktu_tunggu = date('H:i:s', $diff);
                        $tmp = explode(':', $waktu_tunggu);
                        $tmp2 = ((int) $tmp[0]) - 7;
                        $tmp[0] = '0' . $tmp2;
                        $waktu_tunggu = join(':', $tmp);
                    }
                    return $waktu_tunggu;
                },
            ),
            array(
                'title_header_column' 	=> 'Waktu Panggil',
                'field_name' 			=> 'trans_waktu_panggil',
                'no_order'				=> 6,
            ),
            array(
                'title_header_column' 	=> 'Waktu Layanan',
                'field_name' 			=> '1 as waktu_layanan',
                'alias'					=> 'waktu_layanan',
                'no_order'				=> 7,
                'result_format'			=> function( $d, $row ) {
                    $waktu_layanan = '-';
                    if(!empty($row['trans_waktu_finish']) AND $row['trans_waktu_panggil'] != '00:00:00' AND $row['trans_waktu_finish'] != '00:00:00') {
                        $time1 = strtotime($row['trans_waktu_panggil']);
                        $time2 = strtotime($row['trans_waktu_finish']);
                        $diff = $time2 - $time1;
                        $waktu_layanan = date('H:i:s', $diff);
                        $tmp = explode(':', $waktu_layanan);
                        $tmp2 = ((int) $tmp[0]) - 7;
                        $tmp[0] = '0' . $tmp2;
                        $waktu_layanan = join(':', $tmp);
                    }
                    return $waktu_layanan;
                },
            ),
            array(
                'title_header_column' 	=> 'Selesai',
                'field_name' 			=> 'trans_waktu_finish',
                'no_order'				=> 8,
            ),
            array(
                'title_header_column' 	=> 'Nama Layanan',
                'field_name' 			=> 'lay_nama_layanan',
                'no_order'				=> 9,
            ),
            array(
                'title_header_column' 	=> 'User',
                'field_name' 			=> 'admusr_username',
                'no_order'				=> 10,
            ),
            array(
                'title_header_column' 	=> 'Webcam File',
                'field_name' 			=> 'trans_webcam_file',
                'no_order'				=> 11,
                'result_format'			=> function( $d, $row ) {
                	$this->load->model('settings_model', 'settingsx');
			        $tmp_webcam_path = $this->settingsx->where(array('sett_setting' => 'webcam_upload_path'))->get_row();
                	$videoUrl = $tmp_webcam_path['sett_nilai'].$row['trans_webcam_file'];
                	return '<a target="_blank" href="'.$videoUrl.'">'.$row['trans_webcam_file'].'</a>';
                }
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
        $this->_data['dateNow'] = date('Y-m-d');

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

        $this->_data['dateNow'] = date('Y-m-d');

		$this->load->view('lists', $this->_data);
	}

	function lists_ajax_filter() {
		$this->_data['ajax_lists'] 	= site_url($this->_module_controller . 'lists_ajax');
		$this->_data['column_list'] = $this->get_show_column();

		$this->_data['trans_id_layanan'] 		= $this->input->post('trans_id_layanan');
		$this->_data['trans_id_loket'] 			= $this->input->post('trans_id_loket');
		$this->_data['trans_id_user'] 			= $this->input->post('trans_id_user');
		$this->_data['trans_tanggal_transaksi'] = $this->input->post('trans_tanggal_transaksi');
        $dateNow = date('Y-m-d');
        // $this->_data['trans_tanggal_transaksi'] = "$dateNow - $dateNow";
		$this->load->view('lists_filter', $this->_data);
	}

	//--- used by datatable source data -------
	function lists_ajax() {
		$this->load->helper('mydatatable');
		$table 		= $this->db->dbprefix . $this->_table_name;
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'layanan ON (trans_id_layanan = lay_id_layanan) ';
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'group_layanan ON (trans_id_group_layanan = grolay_id_group_layanan) ';
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'lokets ON (trans_id_loket = lokets_id) ';
        $table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'adminusers ON (trans_id_user = admusr_id) ';
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
        $where = [];

		if(!empty($_GET['periode'])) {
			$periode = explode('_', $_GET['periode']);

			$date_start = !empty($periode[0]) ? $periode[0] : '';
			$date_end = !empty($periode[1]) ? $periode[1] : '';

			if(!empty($date_start) AND !empty($date_end)) {
			    $where[] = 'DATE_FORMAT(trans_tanggal_transaksi, "%Y-%m-%d") BETWEEN "'.$date_start.'" AND "'.$date_end.'"';
			}
		}

        if(!empty($_GET['trans_id_layanan'])) {
            $where[] = 'trans_id_layanan = ' . $_GET['trans_id_layanan'];
        }

        if(!empty($_GET['trans_id_loket'])) {
            $where[] = 'trans_id_loket = ' . $_GET['trans_id_loket'];
        }

        if(!empty($_GET['trans_id_user'])) {
            $where[] = 'trans_id_user = ' . $_GET['trans_id_user'];
        }

        if(!empty($where)) {
            $where = join(' AND ', $where);
            $this->db->where($where);
        }

		$this->db->select('trans_webcam_file, lokets_name, lay_nama_layanan, DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal, CONCAT(trans_no_ticket_awal, "", trans_no_ticket) as no_ticket, "-" as waktu_tunggu, "-" as waktu_layanan, admusr_username', false);
		$this->db->from($this->_table_name);
		$this->db->join('layanan', 'trans_id_layanan = lay_id_layanan', 'left');
		$this->db->join('group_layanan', 'trans_id_group_layanan = grolay_id_group_layanan', 'left');
		$this->db->join('lokets', 'trans_id_loket = lokets_id', 'left');
        $this->db->join('adminusers', 'trans_id_user = admusr_id', 'left');
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

        $where = [];

		if(!empty($_GET['periode'])) {
			$periode = explode('_', $_GET['periode']);

			$date_start = !empty($periode[0]) ? $periode[0] : '';
			$date_end = !empty($periode[1]) ? $periode[1] : '';

			if(!empty($date_start) AND !empty($date_end)) {
				$where[] = 'DATE_FORMAT(trans_tanggal_transaksi, "%Y-%m-%d") BETWEEN "'.$date_start.'" AND "'.$date_end.'"';
			}
		}

        if(!empty($_GET['trans_id_layanan'])) {
            $where[] = 'trans_id_layanan = ' . $_GET['trans_id_layanan'];
        }

        if(!empty($_GET['trans_id_loket'])) {
            $where[] = 'trans_id_loket = ' . $_GET['trans_id_loket'];
        }

        if(!empty($_GET['trans_id_user'])) {
            $where[] = 'trans_id_user = ' . $_GET['trans_id_user'];
        }

        if(!empty($where)) {
            $where = join(' AND ', $where);
            $this->db->where($where);
        }

		$this->db->select($this->_table_name . '.*, lokets_name, lay_nama_layanan, DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal, CONCAT(trans_no_ticket_awal, "", trans_no_ticket) as no_ticket, "-" as waktu_tunggu, "-" as waktu_layanan, admusr_username', false);
		$this->db->from($this->_table_name);
		$this->db->join('layanan', 'trans_id_layanan = lay_id_layanan', 'left');
		$this->db->join('group_layanan', 'trans_id_group_layanan = grolay_id_group_layanan', 'left');
		$this->db->join('lokets', 'trans_id_loket = lokets_id', 'left');
        $this->db->join('adminusers', 'trans_id_user = admusr_id', 'left');
		$this->db->order_by('own_tanggal', 'ASC');
		$this->_data['data_master'] = $this->db->get()->result_array();

		$this->template->set('title', 'Antrian : Export Excel All Detail');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_export/export_excel', 'lists_exportexcel', $this->_data);
	}
	
}

?>