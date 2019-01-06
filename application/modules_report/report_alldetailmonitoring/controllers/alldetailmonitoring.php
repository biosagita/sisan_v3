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
            array(
                'field_name' 			=> 'trans_tanggal_transaksi',
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
                'title_header_column' 	=> 'Tipe Antrian',
                'field_name' 			=> 'trans_tipe_antrian',
                'no_order'				=> 11,
                'result_format'			=> function( $d, $row ) {
                    $tipe_antrian = '-';
                    if($row['trans_tipe_antrian'] == 1) $tipe_antrian = 'ONLINE';
                    if($row['trans_tipe_antrian'] == 2) $tipe_antrian = 'OFFLINE';
                    return $tipe_antrian;
                },
            ),
            array(
                'title_header_column' 	=> 'Nama',
                'field_name' 			=> 'trans_nama',
                'no_order'				=> 12,
            ),
            array(
                'title_header_column' 	=> 'Nama Sekolah',
                'field_name' 			=> 'trans_nama_sekolah',
                'no_order'				=> 13,
            ),
            array(
                'title_header_column' 	=> 'NIK NUPTK',
                'field_name' 			=> 'trans_nuptk',
                'no_order'				=> 14,
            ),
            array(
                'title_header_column' 	=> 'Permasalahan',
                'field_name' 			=> 'trans_permasalahan',
                'no_order'				=> 15,
            ),
            array(
                'title_header_column' 	=> 'Tanggapan',
                'field_name' 			=> 'trans_tanggapan',
                'no_order'				=> 16,
            ),
            array(
                'title_header_column' 	=> 'Propinsi',
                'field_name' 			=> 'trans_propinsi',
                'no_order'				=> 17,
            ),
            array(
                'title_header_column' 	=> 'Kabupaten',
                'field_name' 			=> 'trans_kabupaten',
                'no_order'				=> 18,
            ),
            array(
                'title_header_column' 	=> 'Kecamatan',
                'field_name' 			=> 'trans_kecamatan',
                'no_order'				=> 19,
            ),
            array(
                'title_header_column' 	=> 'Kelurahan',
                'field_name' 			=> 'trans_kelurahan',
                'no_order'				=> 20,
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

		/*$this->db->select('lokets_name, lay_nama_layanan, DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal, CONCAT(trans_no_ticket_awal, "", trans_no_ticket) as no_ticket, "-" as waktu_tunggu, "-" as waktu_layanan, admusr_username, trans_tipe_antrian, trans_nama, trans_nama_sekolah, trans_tanggapan, trans_permasalahan, trans_propinsi, trans_kabupaten, trans_kecamatan, trans_kelurahan, trans_nuptk', false);
		$this->db->from($this->_table_name);
		$this->db->join('layanan', 'trans_id_layanan = lay_id_layanan', 'left');
		$this->db->join('group_layanan', 'trans_id_group_layanan = grolay_id_group_layanan', 'left');
		$this->db->join('lokets', 'trans_id_loket = lokets_id', 'left');
        $this->db->join('adminusers', 'trans_id_user = admusr_id', 'left');
		$this->db->order_by('own_tanggal', 'ASC');
		$this->_data['data_master'] = $this->db->get()->result_array();*/
		//print_r($this->_data['data_master']);

		$q = 'SELECT lokets_name, lay_nama_layanan, DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal, CONCAT(trans_no_ticket_awal, "", trans_no_ticket) as no_ticket, "-" as waktu_tunggu, "-" as waktu_layanan, admusr_username, trans_tipe_antrian, trans_nama, trans_nama_sekolah, trans_tanggapan, trans_permasalahan, trans_propinsi, trans_kabupaten, trans_kecamatan, trans_kelurahan, trans_nuptk, 
		tmp.*, 
		tmp_satu.Propinsi as ol_propinsi, 
		tmp_satu.kelurahan as ol_kelurahan, 
		tmp_satu.kecamatan as ol_kecamatan,  
		tmp_satu.no_antrian as ol_no_antrian,  
		tmp_satu.status as ol_status,  
		tmp_satu.loket as ol_loket,  
		tmp_satu.user_process as ol_user_process,  
		tmp_satu.user_request as ol_user_request,  
		tmp_satu.id_tipe as ol_id_tipe,  
		tmp_satu.id_perihal as ol_id_perihal,  
		tmp_satu.jenis_antrian as ol_jenis_antrian,  
		tmp_satu.request_date as ol_request_date,  
		tmp_satu.periode as ol_periode,  
		tmp_satu.updated_date as ol_updated_date,  
		tmp_satu.permasalahan as ol_permasalahan,  
		tmp_satu.tanggapan as ol_tanggapan,  
		tmp_satu.nama as ol_nama,  
		tmp_satu.nama_sekolah as ol_nama_sekolah,  
		tmp_satu.ref_id as ol_ref_id,  
		tmp_satu.nuptk as ol_nuptk,  
		tmp_satu.id_reg as ol_id_reg,  
		tmp_satu.jenis_kelamin as ol_jenis_kelamin  
		FROM (`anf_transaksi`) 
		LEFT JOIN `anf_layanan` ON `trans_id_layanan` = `lay_id_layanan` 
		LEFT JOIN `anf_group_layanan` ON `trans_id_group_layanan` = `grolay_id_group_layanan` 
		LEFT JOIN `anf_lokets` ON `trans_id_loket` = `lokets_id` 
		LEFT JOIN `anf_adminusers` ON `trans_id_user` = `admusr_id` 
		LEFT JOIN `t_master_profile` tmp ON `trans_id_profile` = `id_profile` 
		LEFT JOIN (SELECT avo.*, tmp.Propinsi, tmp.kelurahan, tmp.kecamatan FROM anf_visitor_online avo JOIN t_master_profile tmp ON (avo.user_request = tmp.id_profile)) tmp_satu ON `trans_id_visitor_online` = tmp_satu.`id` 
		'.(!empty($where) ? ('WHERE ' . $where) : '').' 
		ORDER BY `own_tanggal` ASC';

		$res = $this->db->query($q);
		$this->_data['data_master'] = $res->result_array();

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

		/*$this->db->select($this->_table_name . '.*, lokets_name, lay_nama_layanan, DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal, CONCAT(trans_no_ticket_awal, "", trans_no_ticket) as no_ticket, "-" as waktu_tunggu, "-" as waktu_layanan, admusr_username, trans_tipe_antrian, trans_nama, trans_nama_sekolah, trans_tanggapan, trans_permasalahan, trans_propinsi, trans_kabupaten, trans_kecamatan, trans_kelurahan, trans_nuptk', false);
		$this->db->from($this->_table_name);
		$this->db->join('layanan', 'trans_id_layanan = lay_id_layanan', 'left');
		$this->db->join('group_layanan', 'trans_id_group_layanan = grolay_id_group_layanan', 'left');
		$this->db->join('lokets', 'trans_id_loket = lokets_id', 'left');
        $this->db->join('adminusers', 'trans_id_user = admusr_id', 'left');
		$this->db->order_by('own_tanggal', 'ASC');
		$this->_data['data_master'] = $this->db->get()->result_array();*/

		$q = 'SELECT lokets_name, lay_nama_layanan, DATE_FORMAT(trans_tanggal_transaksi, "%d-%m-%Y") as own_tanggal, CONCAT(trans_no_ticket_awal, "", trans_no_ticket) as no_ticket, "-" as waktu_tunggu, "-" as waktu_layanan, admusr_username, trans_tipe_antrian, trans_nama, trans_nama_sekolah, trans_tanggapan, trans_permasalahan, trans_propinsi, trans_kabupaten, trans_kecamatan, trans_kelurahan, trans_nuptk, 
		tmp.*, 
		tmp_satu.Propinsi as ol_propinsi, 
		tmp_satu.kelurahan as ol_kelurahan, 
		tmp_satu.kecamatan as ol_kecamatan,  
		tmp_satu.no_antrian as ol_no_antrian,  
		tmp_satu.status as ol_status,  
		tmp_satu.loket as ol_loket,  
		tmp_satu.user_process as ol_user_process,  
		tmp_satu.user_request as ol_user_request,  
		tmp_satu.id_tipe as ol_id_tipe,  
		tmp_satu.id_perihal as ol_id_perihal,  
		tmp_satu.jenis_antrian as ol_jenis_antrian,  
		tmp_satu.request_date as ol_request_date,  
		tmp_satu.periode as ol_periode,  
		tmp_satu.updated_date as ol_updated_date,  
		tmp_satu.permasalahan as ol_permasalahan,  
		tmp_satu.tanggapan as ol_tanggapan,  
		tmp_satu.nama as ol_nama,  
		tmp_satu.nama_sekolah as ol_nama_sekolah,  
		tmp_satu.ref_id as ol_ref_id,  
		tmp_satu.nuptk as ol_nuptk,  
		tmp_satu.id_reg as ol_id_reg,  
		tmp_satu.jenis_kelamin as ol_jenis_kelamin  
		FROM (`anf_transaksi`) 
		LEFT JOIN `anf_layanan` ON `trans_id_layanan` = `lay_id_layanan` 
		LEFT JOIN `anf_group_layanan` ON `trans_id_group_layanan` = `grolay_id_group_layanan` 
		LEFT JOIN `anf_lokets` ON `trans_id_loket` = `lokets_id` 
		LEFT JOIN `anf_adminusers` ON `trans_id_user` = `admusr_id` 
		LEFT JOIN `t_master_profile` tmp ON `trans_id_profile` = `id_profile` 
		LEFT JOIN (SELECT avo.*, tmp.Propinsi, tmp.kelurahan, tmp.kecamatan FROM anf_visitor_online avo JOIN t_master_profile tmp ON (avo.user_request = tmp.id_profile)) tmp_satu ON `trans_id_visitor_online` = tmp_satu.`id` 
		'.(!empty($where) ? ('WHERE ' . $where) : '').' 
		ORDER BY `own_tanggal` ASC';

		$res = $this->db->query($q);
		$this->_data['data_master'] = $res->result_array();

		$this->template->set('title', 'Antrian : Export Excel All Detail');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_export/export_excel', 'lists_exportexcel', $this->_data);
	}
	
}

?>