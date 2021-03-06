<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Loket extends MY_Counter
{
    private $_template = 'template_counter/main';
    private $_module_controller = 'counter_loket/loket/';
    private $_table_name = 'transaksi';
    private $_table_field_pref = 'trans_';
    private $_table_pk = 'trans_id_transaksi';
    private $_model_crud = 'transaksi_model';

    private $_page_title = 'Antrian : Counter Loket';
    private $_page_content_info = array(
        'title' => 'Data Counter Loket',
        'desc' => 'List counter loket',
    );

    function __construct()
    {
        parent::__construct();

        $cookieset = $this->input->cookie($this->_data['cookie_name'], true);
        if (empty($cookieset)) {
            redirect('counter_loketdestination/loketdestination');
            exit();
        }

        if (!$this->session->userdata('admin_id') OR (!in_array($this->session->userdata('admin_userlevel'), array(1, 2)))) {
            redirect('counter_login/login');
            exit();
        }
    }

    private function get_additional_field()
    {
        $additional_field = array(
            array(
                'field_name' => 'grolay_nama_group_layanan',
                'just_info' => true,
            ),
            array(
                'field_name' => 'trans_no_ticket_awal',
                'just_info' => true,
            ),
            array(
                'field_name' => 'trans_no_ticket',
                'just_info' => true,
            ),
            array(
                'field_name' => 'prilay_id_group_loket',
                'just_info' => true,
            ),
            array(
                'field_name' => 'trans_id_group_layanan',
                'just_info' => true,
            ),
            array(
                'field_name' => 'trans_status_transaksi',
                'just_info' => true,
            ),
            array(
                'field_name' => 'trans_tanggal_transaksi',
                'just_info' => true,
            ),
        );

        return $additional_field;
    }

    private function get_show_column()
    {
        $column_list = array(
            array(
                'title_header_column' => 'No.',
                'field_name' => $this->_table_field_pref . 'id_transaksi',
                'show_no_static' => true,
                'no_order' => 0,
            ),
            array(
                'title_header_column' => 'No Ticket',
                'field_name' => 'CONCAT(trans_no_ticket_awal, "", trans_no_ticket) as ticket',
                'alias' => 'ticket',
                'no_order' => 1,
            ),
            // array(
            //     'title_header_column' => 'Type',
            //     'field_name' => 'grolay_nama_group_layanan',
            //     'no_order' => 2,
            // ),
            array(
                'title_header_column' => 'Nama',
                'field_name' => 'vst_nama',
                'no_order' => 2,
            ),
            array(
                'title_header_column' => 'Time In',
                'field_name' => $this->_table_field_pref . 'waktu_ambil',
                'no_order' => 3,
            ),
            array(
                'title_header_column' => 'Action',
                'field_name' => $this->_table_field_pref . 'id_transaksi',
                'result_format' => function ($d, $row) {
                    return '<a onclick="fnNext(' . $d . ');return false;" href="#" class="btn btn-xs btn-success">NEXT <i class="glyph-icon icon-pencil-square-o"></i></a>';
                },
                'no_order' => 4,
            ),
        );

        return $column_list;
    }

    private function get_show_column_skip()
    {
        $column_list = array(
            array(
                'title_header_column' => 'No.',
                'field_name' => $this->_table_field_pref . 'id_transaksi',
                'show_no_static' => true,
                'no_order' => 0,
            ),
            array(
                'title_header_column' => 'No Ticket',
                'field_name' => 'CONCAT(trans_no_ticket_awal, "", trans_no_ticket) as ticket',
                'alias' => 'ticket',
                'no_order' => 1,
            ),
            // array(
            //     'title_header_column' => 'Type',
            //     'field_name' => 'grolay_nama_group_layanan',
            //     'no_order' => 2,
            // ),
            array(
                'title_header_column' => 'Nama',
                'field_name' => 'vst_nama',
                'no_order' => 2,
            ),
            array(
                'title_header_column' => 'Time In',
                'field_name' => $this->_table_field_pref . 'waktu_ambil',
                'no_order' => 3,
            ),
            array(
                'title_header_column' => 'Action',
                'field_name' => $this->_table_field_pref . 'id_transaksi',
                'result_format' => function ($d, $row) {
                    return '<a onclick="fnUndo(' . $d . ');return false;" href="#" class="btn btn-xs btn-success">UNDO <i class="glyph-icon icon-pencil-square-o"></i></a>';
                },
                'no_order' => 4,
            ),
        );

        return $column_list;
    }

    private function get_show_column_finish()
    {
        $column_list = array(
            array(
                'title_header_column' => 'No.',
                'field_name' => $this->_table_field_pref . 'id_transaksi',
                'show_no_static' => true,
                'no_order' => 0,
            ),
            array(
                'title_header_column' => 'No Ticket',
                'field_name' => 'CONCAT(trans_no_ticket_awal, "", trans_no_ticket) as ticket',
                'alias' => 'ticket',
                'no_order' => 1,
            ),
            // array(
            //     'title_header_column' => 'Type',
            //     'field_name' => 'grolay_nama_group_layanan',
            //     'no_order' => 2,
            // ),
            array(
                'title_header_column' => 'Nama',
                'field_name' => 'vst_nama',
                'no_order' => 2,
            ),
            array(
                'title_header_column' => 'Time Call',
                'field_name' => $this->_table_field_pref . 'waktu_panggil',
                'no_order' => 3,
            ),
        );

        return $column_list;
    }

    function index()
    {
        $this->lists();
    }

    function lists()
    {
        $this->load->model('lokets_model', 'loketsx');
        $tmp = $this->loketsx->where(array('lokets_id' => $this->_data['cookie_loket_id']))->get_row();
        $this->_data['loket_name'] = $tmp['lokets_name'];

        $this->load->model('adminuser_model', 'adminuserx');
        $tmp2 = $this->adminuserx->where(array('admusr_id' => $this->session->userdata('admin_id')))->get_login_userlevel();
        $this->_data['login_name'] = $tmp2['admusr_username'] . ' (' . $tmp['lokets_type'] . ')';

        $this->load->model('layanans_model', 'layanansx');
        $this->_data['layanan_forward'] = $this->layanansx->get_layanancounter($this->_data['cookie_loket_id']);

        $this->_data['ajax_lists'] = site_url($this->_module_controller . 'lists_ajax');
        $this->_data['ajax_lists_skip'] = site_url($this->_module_controller . 'lists_ajax_skip');
        $this->_data['ajax_lists_finish'] = site_url($this->_module_controller . 'lists_ajax_finish');

        $this->_data['fnGoToNext'] = site_url($this->_module_controller . 'fnGoToNext');
        $this->_data['fnFinish'] = site_url($this->_module_controller . 'fnFinish');
        $this->_data['fnForward'] = site_url($this->_module_controller . 'fnForward');
        $this->_data['fnNext'] = site_url($this->_module_controller . 'fnNext');
        $this->_data['fnRecall'] = site_url($this->_module_controller . 'fnRecall');
        $this->_data['fnSkip'] = site_url($this->_module_controller . 'fnSkip');
        $this->_data['fnUndo'] = site_url($this->_module_controller . 'fnUndo');
        $this->_data['uploadWebCam'] = site_url($this->_module_controller . 'uploadWebCam');

        $this->_data['column_list'] = $this->get_show_column();
        $this->_data['column_list'] = $this->get_show_column();
        $this->_data['column_list_skip'] = $this->get_show_column_skip();
        $this->_data['column_list_finish'] = $this->get_show_column_finish();

        $this->_data['info_page'] = $this->_page_content_info;

        $this->_data['blank_image'] = site_url('assets/blank_user.jpg');
        $this->_data['sample_image'] = site_url('assets/sample.jpg');

        //using lib template
        $this->template->set('title', $this->_page_title);
        $this->template->set('loket_name', $this->_data['loket_name']);
        $this->template->set('login_name', $this->_data['login_name']);
        $this->template->set('assets', $this->_data['assets']);
        $this->template->set('assets_front', $this->_data['assets_front']);
        $this->template->set('url_logout', $this->_data['url_logout']);
        $this->template->set('layanan_forward', $this->_data['layanan_forward']);
        $this->template->set('sample_image', $this->_data['sample_image']);
        $this->template->load($this->_template, 'lists', $this->_data);
    }

    function page_content_ajax()
    {
        $this->_data['page_content_ajax'] = site_url($this->_module_controller . 'page_content_ajax');
        $this->_data['ajax_lists'] = site_url($this->_module_controller . 'lists_ajax');
        $this->_data['ajax_lists_skip'] = site_url($this->_module_controller . 'lists_ajax_skip');
        $this->_data['ajax_lists_finish'] = site_url($this->_module_controller . 'lists_ajax_finish');

        $this->_data['column_list'] = $this->get_show_column();
        $this->_data['column_list_skip'] = $this->get_show_column_skip();
        $this->_data['column_list_finish'] = $this->get_show_column_finish();

        $this->_data['info_page'] = $this->_page_content_info;

        $this->_data['blank_image'] = site_url('assets/blank_user.jpg');
        $this->_data['sample_image'] = site_url('assets/sample.jpg');

        $this->load->view('lists', $this->_data);
    }

    //--- used by datatable source data -------
    function lists_ajax()
    {
        $this->load->helper('mydatatable');
        $table = $this->db->dbprefix . $this->_table_name;
        $table .= ' LEFT JOIN ' . $this->db->dbprefix . 'group_layanan ON (trans_id_group_layanan = grolay_id_group_layanan) ';
        $table .= ' LEFT JOIN ' . $this->db->dbprefix . 'prioritas_layanan ON (trans_id_group_layanan = prilay_id_group_layanan) ';
        $table .= ' LEFT JOIN ' . $this->db->dbprefix . 'visitor ON (trans_id_visitor = vst_id_visitor) ';
        $primaryKey = $this->_table_pk;
        $column_list = $this->get_show_column();
        $columns = array();
        $cnt = 0;
        foreach ($column_list as $key => $value) {
            $columns[] = array(
                'db' => $value['field_name'],
                'dt' => !empty($value['no_order']) ? $value['no_order'] : $cnt,
                'formatter' => !empty($value['result_format']) ? $value['result_format'] : '',
                'show_no_static' => !empty($value['show_no_static']) ? $value['show_no_static'] : '',
                'just_info' => !empty($value['just_info']) ? $value['just_info'] : '',
                'alias' => !empty($value['alias']) ? $value['alias'] : '',
                'ignore_search' => !empty($value['ignore_search']) ? $value['ignore_search'] : '',
            );
            $cnt++;
        }

        $additional_field = $this->get_additional_field();

        if (!empty($additional_field)) {
            foreach ($additional_field as $key => $value) {
                $columns[] = array(
                    'db' => $value['field_name'],
                    'dt' => !empty($value['no_order']) ? $value['no_order'] : $cnt,
                    'formatter' => !empty($value['result_format']) ? $value['result_format'] : '',
                    'show_no_static' => !empty($value['show_no_static']) ? $value['show_no_static'] : '',
                    'just_info' => !empty($value['just_info']) ? $value['just_info'] : '',
                    'alias' => !empty($value['alias']) ? $value['alias'] : '',
                    'ignore_search' => !empty($value['ignore_search']) ? $value['ignore_search'] : '',
                );
                $cnt++;
            }
        }

        $Loket = $this->_data['cookie_loket_id'];

        $currentDate = date('Ymd');
        $q = 'SELECT prilay_id_group_layanan, prilay_id_group_loket 
		FROM anf_lokets JOIN anf_prioritas_layanan ON (lokets_grolok_id = prilay_id_group_loket) 
		WHERE lokets_id = ' . $Loket;

        $query = $this->db->query($q);
        $listlayanan = array();
        $grouploket = '';
        foreach ($query->result() as $vRow) {
            $listlayanan[] = $vRow->prilay_id_group_layanan;
            $grouploket = $vRow->prilay_id_group_loket;
        }

        $scheduleCondition = $this->getScheduleCondition($listlayanan);

        $orderBy = ' ORDER BY prilay_prioritas, trans_waktu_ambil';
        $whereResult = '';
        $whereAll = 'prilay_id_group_loket = (' . $grouploket . ') AND trans_id_group_layanan IN (' . join(',', $listlayanan) . ') AND trans_status_transaksi = 0 AND trans_tanggal_transaksi = "' . $currentDate . '" ' . $scheduleCondition . $orderBy;

        //echo 'xxx - ' . $whereAll; exit();

        generateDataTable($table, $primaryKey, $columns, $whereResult, $whereAll);
    }

    function lists_ajax_skip()
    {
        $this->load->helper('mydatatable');
        $table = $this->db->dbprefix . $this->_table_name;
        $table .= ' LEFT JOIN ' . $this->db->dbprefix . 'group_layanan ON (trans_id_group_layanan = grolay_id_group_layanan) ';
        $table .= ' LEFT JOIN ' . $this->db->dbprefix . 'prioritas_layanan ON (trans_id_group_layanan = prilay_id_group_layanan) ';
        $table .= ' LEFT JOIN ' . $this->db->dbprefix . 'visitor ON (trans_id_visitor = vst_id_visitor) ';
        $primaryKey = $this->_table_pk;
        $column_list = $this->get_show_column_skip();
        $columns = array();
        $cnt = 0;
        foreach ($column_list as $key => $value) {
            $columns[] = array(
                'db' => $value['field_name'],
                'dt' => !empty($value['no_order']) ? $value['no_order'] : $cnt,
                'formatter' => !empty($value['result_format']) ? $value['result_format'] : '',
                'show_no_static' => !empty($value['show_no_static']) ? $value['show_no_static'] : '',
                'just_info' => !empty($value['just_info']) ? $value['just_info'] : '',
                'alias' => !empty($value['alias']) ? $value['alias'] : '',
                'ignore_search' => !empty($value['ignore_search']) ? $value['ignore_search'] : '',
            );
            $cnt++;
        }

        $additional_field = $this->get_additional_field();

        if (!empty($additional_field)) {
            foreach ($additional_field as $key => $value) {
                $columns[] = array(
                    'db' => $value['field_name'],
                    'dt' => !empty($value['no_order']) ? $value['no_order'] : $cnt,
                    'formatter' => !empty($value['result_format']) ? $value['result_format'] : '',
                    'show_no_static' => !empty($value['show_no_static']) ? $value['show_no_static'] : '',
                    'just_info' => !empty($value['just_info']) ? $value['just_info'] : '',
                    'alias' => !empty($value['alias']) ? $value['alias'] : '',
                    'ignore_search' => !empty($value['ignore_search']) ? $value['ignore_search'] : '',
                );
                $cnt++;
            }
        }

        $Loket = $this->_data['cookie_loket_id'];

        $currentDate = date('Ymd');
        $q = 'SELECT prilay_id_group_layanan, prilay_id_group_loket 
		FROM anf_lokets JOIN anf_prioritas_layanan ON (lokets_grolok_id = prilay_id_group_loket) 
		WHERE lokets_id = ' . $Loket;

        $query = $this->db->query($q);
        $listlayanan = array();
        $grouploket = '';
        foreach ($query->result() as $vRow) {
            $listlayanan[] = $vRow->prilay_id_group_layanan;
            $grouploket = $vRow->prilay_id_group_loket;
        }

        $scheduleCondition = $this->getScheduleCondition($listlayanan);

        $orderBy = ' ORDER BY prilay_prioritas, trans_waktu_ambil';
        $whereResult = '';
        $whereAll = 'prilay_id_group_loket = (' . $grouploket . ') AND trans_id_group_layanan IN (' . join(',', $listlayanan) . ') AND trans_status_transaksi = 3 AND trans_tanggal_transaksi = "' . $currentDate . '" ' . $scheduleCondition . $orderBy;
        generateDataTable($table, $primaryKey, $columns, $whereResult, $whereAll);
    }

    function lists_ajax_finish()
    {
        $this->load->helper('mydatatable');
        $table = $this->db->dbprefix . $this->_table_name;
        $table .= ' LEFT JOIN ' . $this->db->dbprefix . 'group_layanan ON (trans_id_group_layanan = grolay_id_group_layanan) ';
        $table .= ' LEFT JOIN ' . $this->db->dbprefix . 'prioritas_layanan ON (trans_id_group_layanan = prilay_id_group_layanan) ';
        $table .= ' LEFT JOIN ' . $this->db->dbprefix . 'visitor ON (trans_id_visitor = vst_id_visitor) ';
        $primaryKey = $this->_table_pk;
        $column_list = $this->get_show_column_finish();
        $columns = array();
        $cnt = 0;
        foreach ($column_list as $key => $value) {
            $columns[] = array(
                'db' => $value['field_name'],
                'dt' => !empty($value['no_order']) ? $value['no_order'] : $cnt,
                'formatter' => !empty($value['result_format']) ? $value['result_format'] : '',
                'show_no_static' => !empty($value['show_no_static']) ? $value['show_no_static'] : '',
                'just_info' => !empty($value['just_info']) ? $value['just_info'] : '',
                'alias' => !empty($value['alias']) ? $value['alias'] : '',
                'ignore_search' => !empty($value['ignore_search']) ? $value['ignore_search'] : '',
            );
            $cnt++;
        }

        $additional_field = $this->get_additional_field();

        if (!empty($additional_field)) {
            foreach ($additional_field as $key => $value) {
                $columns[] = array(
                    'db' => $value['field_name'],
                    'dt' => !empty($value['no_order']) ? $value['no_order'] : $cnt,
                    'formatter' => !empty($value['result_format']) ? $value['result_format'] : '',
                    'show_no_static' => !empty($value['show_no_static']) ? $value['show_no_static'] : '',
                    'just_info' => !empty($value['just_info']) ? $value['just_info'] : '',
                    'alias' => !empty($value['alias']) ? $value['alias'] : '',
                    'ignore_search' => !empty($value['ignore_search']) ? $value['ignore_search'] : '',
                );
                $cnt++;
            }
        }

        $Loket = $this->_data['cookie_loket_id'];

        $currentDate = date('Ymd');
        $q = 'SELECT prilay_id_group_layanan, prilay_id_group_loket 
		FROM anf_lokets JOIN anf_prioritas_layanan ON (lokets_grolok_id = prilay_id_group_loket) 
		WHERE lokets_id = ' . $Loket;

        $query = $this->db->query($q);
        $listlayanan = array();
        $grouploket = '';
        foreach ($query->result() as $vRow) {
            $listlayanan[] = $vRow->prilay_id_group_layanan;
            $grouploket = $vRow->prilay_id_group_loket;
        }

        $scheduleCondition = $this->getScheduleCondition($listlayanan);

        $orderBy = ' ORDER BY prilay_prioritas, trans_waktu_ambil';
        $whereResult = '';
        $whereAll = 'prilay_id_group_loket = (' . $grouploket . ') AND trans_id_group_layanan IN (' . join(',', $listlayanan) . ') AND trans_status_transaksi = 5 AND trans_tanggal_transaksi = "' . $currentDate . '" ' . $scheduleCondition . $orderBy;
        generateDataTable($table, $primaryKey, $columns, $whereResult, $whereAll);
    }

    function fnGoToNext($ticket_number = '')
    {
        $ticket_number = $this->input->post('ticket_number');

        $lenticketnumber = strlen($ticket_number);
        $trans_no_ticket_awal = strtoupper(substr($ticket_number, 0, 1));
        $trans_no_ticket = substr($ticket_number, 1, $lenticketnumber);

        $vArrayTemp = array(
            'trans_id_transaksi' => '',
            'no_tiket' => '',
            'transaction' => '',
            'start' => '',
            'sRegVisitor' => '',
            'layanan_forward' => '',
            'id_group_layanan' => '',
        );

        $trans_tanggal_transaksi = date('Ymd');
        $trans_waktu_panggil = date("H:i:s");
        $waktu_finish = $trans_waktu_panggil;

        $Loket = $this->_data['cookie_loket_id'];

        $q = 'SELECT prilay_id_group_layanan 
		FROM anf_lokets 
		JOIN anf_prioritas_layanan ON (lokets_grolok_id = prilay_id_group_loket) 
		WHERE lokets_id = ' . $Loket;

        $query = $this->db->query($q);
        $listlayanan = array();
        foreach ($query->result() as $vRow) {
            $listlayanan[] = $vRow->prilay_id_group_layanan;
        }

        $scheduleCondition = $this->getScheduleCondition($listlayanan);

        $cal_next = $this->db->query("SELECT trans_nama_file,trans_id_transaksi,trans_no_ticket_awal,trans_no_ticket,lay_nama_layanan,trans_waktu_ambil, lay_id_group_layanan, lay_id_layanan_forward, lay_estimasi, anf_visitor.* 
			FROM anf_transaksi 
			LEFT JOIN anf_layanan ON trans_id_layanan = lay_id_layanan 
			JOIN anf_prioritas_layanan ON (trans_id_group_layanan = prilay_id_group_layanan) 
			LEFT JOIN anf_visitor ON (trans_id_visitor = vst_id_visitor) 
			where trans_status_transaksi = '0' and trans_id_group_layanan IN (" . join(',', $listlayanan) . ") and trans_tanggal_transaksi='$trans_tanggal_transaksi' and trans_no_ticket_awal = '$trans_no_ticket_awal' and trans_no_ticket = '$trans_no_ticket' ".$scheduleCondition." 
			order by prilay_prioritas ASC, trans_id_transaksi asc LIMIT 1");

        $vRow_next = $cal_next->row_array();

        if (!empty($vRow_next['trans_id_transaksi'])) {

            $trans_id_transaksi = $vRow_next['trans_id_transaksi'];
            $next_id = $vRow_next['trans_no_ticket'];
            $transaction = $vRow_next['lay_nama_layanan'];
            $trans_waktu_ambil = $vRow_next['trans_waktu_ambil'];
            $lay_id_layanan_forward = $vRow_next['lay_id_layanan_forward'];
            $estimasi = $vRow_next['lay_estimasi'];
            $nama_file = $vRow_next['trans_nama_file'];
            $no_tiket_awal = $vRow_next['trans_no_ticket_awal'];

            //for detail visitor
            $vst_nomor = $vRow_next['vst_nomor'];
            $vst_nama = $vRow_next['vst_nama'];
            $vst_alamat = $vRow_next['vst_alamat'];
            $vst_phone = $vRow_next['vst_phone'];
            $vst_sex = $vRow_next['vst_sex'];
            $vst_email = $vRow_next['vst_email'];

            $ct_id_lay = $this->db->query("SELECT trans_tanggal_transaksi,trans_no_ticket_awal,trans_no_ticket,grolay_nama_group_layanan,trans_waktu_panggil,trans_id_layanan,trans_id_group_layanan 
				from anf_transaksi 
				join anf_group_layanan ON trans_id_group_layanan=grolay_id_group_layanan 
				where trans_status_transaksi IN (1,2) and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi' ".$scheduleCondition." 
				order by trans_id_transaksi desc ");
            $_countmk3 = $ct_id_lay->row_array();

            $q = 'SELECT * FROM anf_layanan';
            $query = $this->db->query($q);
            $daftarlayanan = array();
            foreach ($query->result() as $vRow) {
                $daftarlayanan[$vRow->lay_id_layanan] = (array)$vRow;
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
            $vArrayTemp['no_tiket_awal'] = $no_tiket_awal;

            //for detail visitor
            $vArrayTemp['vst_nomor'] = $vst_nomor;
            $vArrayTemp['vst_nama'] = $vst_nama;
            $vArrayTemp['vst_alamat'] = $vst_alamat;
            $vArrayTemp['vst_phone'] = $vst_phone;
            $vArrayTemp['vst_sex'] = $vst_sex;
            $vArrayTemp['vst_email'] = $vst_email;

            /*
            $sql=$this->db->query("UPDATE anf_transaksi
                set trans_status_transaksi='1',trans_waktu_panggil='$trans_waktu_panggil',trans_id_loket='$Loket'
                where trans_no_ticket='$next_id' and trans_id_group_layanan IN (".join(',', $listlayanan).") and trans_tanggal_transaksi='$trans_tanggal_transaksi'");
            */

            $sql = $this->db->query("UPDATE anf_transaksi 
				set trans_status_transaksi='1',trans_waktu_panggil='$trans_waktu_panggil',trans_id_loket='$Loket' 
				where trans_no_ticket_awal = '$no_tiket_awal' and trans_no_ticket='$next_id' and trans_id_group_layanan IN (" . join(',', $listlayanan) . ") and trans_tanggal_transaksi='$trans_tanggal_transaksi'");

            if ($_countmk3['trans_tanggal_transaksi'] > '0') {
                $sql = $this->db->query("UPDATE anf_transaksi 
					set trans_waktu_finish='$waktu_finish', trans_status_transaksi='5', trans_id_user='" . $this->session->userdata('admin_id') . "' 
					where trans_no_ticket_awal = '$_countmk3[trans_no_ticket_awal]' and trans_no_ticket='$_countmk3[trans_no_ticket]' and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi' ");

                $lay_id_layanan_forward = $daftarlayanan[$_countmk3['trans_id_layanan']]['lay_id_layanan_forward'];

                if (!empty($lay_id_layanan_forward)) {
                    $vItems = array(
                        'trans_tanggal_transaksi' => $trans_tanggal_transaksi,
                        'trans_waktu_ambil' => $trans_waktu_panggil,
                        'trans_no_ticket_awal' => $_countmk3['trans_no_ticket_awal'],
                        'trans_no_ticket' => $_countmk3['trans_no_ticket'],
                        'id_layanan' => $lay_id_layanan_forward,
                        'id_group_layanan' => $daftarlayanan[$lay_id_layanan_forward]['lay_id_group_layanan'],
                    );

                    $sql = $this->db->query("INSERT INTO anf_transaksi (trans_tanggal_transaksi,trans_waktu_ambil,trans_no_ticket_awal,trans_no_ticket,trans_id_layanan,trans_id_group_layanan) 
				  VALUES ('$vItems[trans_tanggal_transaksi]', '$vItems[trans_waktu_ambil]','$vItems[trans_no_ticket_awal]', '$vItems[trans_no_ticket]','$vItems[id_layanan]','$vItems[id_group_layanan]')");
                }
            }
        }
        echo json_encode($vArrayTemp);
    }

    function fnFinish()
    {
        $result = array(
            'success' => true,
        );

        $trans_tanggal_transaksi = date('Ymd');
        $trans_waktu_panggil = date("H:i:s");
        $waktu_finish = $trans_waktu_panggil;

        $Loket = $this->_data['cookie_loket_id'];

        $q = 'SELECT prilay_id_group_layanan 
		FROM anf_lokets 
		JOIN anf_prioritas_layanan ON (lokets_grolok_id = prilay_id_group_loket) 
		WHERE lokets_id = ' . $Loket;

        $query = $this->db->query($q);
        $listlayanan = array();
        foreach ($query->result() as $vRow) {
            $listlayanan[] = $vRow->prilay_id_group_layanan;
        }

        $scheduleCondition = $this->getScheduleCondition($listlayanan);

        $ct_id_lay = $this->db->query("SELECT trans_tanggal_transaksi,trans_no_ticket_awal,trans_no_ticket,grolay_nama_group_layanan,trans_waktu_panggil,trans_id_layanan,trans_id_group_layanan 
			from anf_transaksi 
			JOIN anf_group_layanan ON trans_id_group_layanan=grolay_id_group_layanan 
			where trans_status_transaksi IN (1,2) and trans_id_group_layanan IN (" . join(',', $listlayanan) . ") and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi' ".$scheduleCondition." 
			order by trans_id_transaksi desc ");

        $_countmk3 = $ct_id_lay->row_array();

        if ($_countmk3['trans_tanggal_transaksi'] > '0') {
            $sql = $this->db->query("UPDATE anf_transaksi 
		  	set trans_waktu_finish='$waktu_finish', trans_status_transaksi='5', trans_id_user='" . $this->session->userdata('admin_id') . "' 
		  	where trans_no_ticket_awal='$_countmk3[trans_no_ticket_awal]' and trans_no_ticket='$_countmk3[trans_no_ticket]' and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi' ");

            $q = 'SELECT * FROM anf_layanan';
            $query = $this->db->query($q);
            $daftarlayanan = array();
            foreach ($query->result() as $vRow) {
                $daftarlayanan[$vRow->lay_id_layanan] = (array)$vRow;
            }

            $lay_id_layanan_forward = $daftarlayanan[$_countmk3['trans_id_layanan']]['lay_id_layanan_forward'];

            if (!empty($lay_id_layanan_forward)) {
                $vItems = array(
                    'trans_tanggal_transaksi' => $trans_tanggal_transaksi,
                    'trans_waktu_ambil' => $trans_waktu_panggil,
                    'trans_no_ticket_awal' => $_countmk3['trans_no_ticket_awal'],
                    'trans_no_ticket' => $_countmk3['trans_no_ticket'],
                    'id_layanan' => $lay_id_layanan_forward,
                    'id_group_layanan' => $daftarlayanan[$lay_id_layanan_forward]['lay_id_group_layanan'],
                );

                $sql = $this->db->query("INSERT INTO anf_transaksi (trans_tanggal_transaksi,trans_waktu_ambil,trans_no_ticket_awal,trans_no_ticket,trans_id_layanan,trans_id_group_layanan) 
				VALUES ('$vItems[trans_tanggal_transaksi]', '$vItems[trans_waktu_ambil]','$vItems[trans_no_ticket_awal]', '$vItems[trans_no_ticket]','$vItems[id_layanan]','$vItems[id_group_layanan]')");
            }
        }
        echo json_encode($result);
    }

    function fnNext($trans_id_transaksi = '')
    {
        $trans_id_transaksi = $this->input->post('id');

        $trans_tanggal_transaksi = date('Ymd');
        $trans_waktu_panggil = date("H:i:s");
        $waktu_finish = $trans_waktu_panggil;

        $Loket = $this->_data['cookie_loket_id'];

        $q = 'SELECT prilay_id_group_layanan, prilay_id_group_loket 
		FROM anf_lokets 
		JOIN anf_prioritas_layanan ON (lokets_grolok_id = prilay_id_group_loket) 
		WHERE lokets_id = ' . $Loket;

        $query = $this->db->query($q);
        $listlayanan = array();
        $grouploket = '';
        foreach ($query->result() as $vRow) {
            $listlayanan[] = $vRow->prilay_id_group_layanan;
            $grouploket = $vRow->prilay_id_group_loket;
        }

        $addWhere = !empty($trans_id_transaksi) ? ('trans_id_transaksi = "' . $trans_id_transaksi . '" AND ') : '';

        $scheduleCondition = $this->getScheduleCondition($listlayanan);

        $cal_next = $this->db->query('SELECT trans_nama_file,trans_id_transaksi,trans_no_ticket_awal,trans_no_ticket,lay_nama_layanan,trans_waktu_ambil, lay_id_group_layanan, lay_id_layanan_forward, lay_estimasi, anf_visitor.*  
			FROM anf_transaksi 
			LEFT JOIN anf_layanan ON trans_id_layanan=lay_id_layanan 
			JOIN anf_prioritas_layanan ON (trans_id_group_layanan = prilay_id_group_layanan) 
			LEFT JOIN anf_visitor ON (trans_id_visitor = vst_id_visitor) 
			WHERE ' . $addWhere . ' prilay_id_group_loket = (' . $grouploket . ') AND trans_id_group_layanan IN (' . join(',', $listlayanan) . ') AND trans_status_transaksi = 0 AND trans_tanggal_transaksi = "' . $trans_tanggal_transaksi . '" ' . $scheduleCondition . '
			ORDER BY prilay_prioritas ASC, trans_id_transaksi LIMIT 1');

        $vRow_next = $cal_next->row_array();
        $trans_id_transaksi = $vRow_next['trans_id_transaksi'];
        $next_id = $vRow_next['trans_no_ticket'];
        $transaction = $vRow_next['lay_nama_layanan'];
        $trans_waktu_ambil = $vRow_next['trans_waktu_ambil'];
        $lay_id_layanan_forward = $vRow_next['lay_id_layanan_forward'];
        $estimasi = $vRow_next['lay_estimasi'];
        $nama_file = $vRow_next['trans_nama_file'];
        $no_tiket_awal = $vRow_next['trans_no_ticket_awal'];

        //for detail visitor
        $vst_nomor = $vRow_next['vst_nomor'];
        $vst_nama = $vRow_next['vst_nama'];
        $vst_alamat = $vRow_next['vst_alamat'];
        $vst_phone = $vRow_next['vst_phone'];
        $vst_sex = $vRow_next['vst_sex'];
        $vst_email = $vRow_next['vst_email'];

        $ct_id_lay = $this->db->query("SELECT trans_tanggal_transaksi,trans_no_ticket_awal,trans_no_ticket,grolay_nama_group_layanan,trans_waktu_panggil,trans_id_layanan,trans_id_group_layanan from anf_transaksi 
			JOIN anf_group_layanan ON trans_id_group_layanan=grolay_id_group_layanan 
			where trans_status_transaksi IN (1,2) and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi' ".$scheduleCondition."
			order by trans_id_transaksi desc ");

        $_countmk3 = $ct_id_lay->row_array();

        $ct_id_skip = $this->db->query("SELECT trans_id_transaksi 
			from anf_transaksi where trans_status_transaksi='2' and trans_tanggal_transaksi='$trans_tanggal_transaksi' ".$scheduleCondition."
			order by trans_id_transaksi asc ");

        $id_skip = $ct_id_skip->row_array();
        $skip_id = $id_skip['trans_id_transaksi'];


        //cek Layanan Forward-------------------------------------------
        $data_fwd = $this->db->query("SELECT lay_id_group_layanan,lay_id_layanan_forward 
	    	from anf_layanan 
	    	where lay_id_layanan='$_countmk3[trans_id_layanan]'");

        $data_fw = $data_fwd->row_array();


        $sql_cek_fw_group = $this->db->query("SELECT lay_id_group_layanan 
	    	from anf_layanan 
	    	where lay_id_layanan='$data_fw[lay_id_layanan_forward]'");

        $data_fw_group = $sql_cek_fw_group->row_array();

        $q = 'SELECT * FROM anf_layanan';
        $query = $this->db->query($q);
        $daftarlayanan = array();
        foreach ($query->result() as $vRow) {
            $daftarlayanan[$vRow->lay_id_layanan] = (array)$vRow;
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
        $vArrayTemp['no_tiket_awal'] = $no_tiket_awal;

        //for detail visitor
        $vArrayTemp['vst_nomor'] = $vst_nomor;
        $vArrayTemp['vst_nama'] = $vst_nama;
        $vArrayTemp['vst_alamat'] = $vst_alamat;
        $vArrayTemp['vst_phone'] = $vst_phone;
        $vArrayTemp['vst_sex'] = $vst_sex;
        $vArrayTemp['vst_email'] = $vst_email;

        echo json_encode($vArrayTemp);

        /*
        $sql=$this->db->query("UPDATE anf_transaksi
              set  trans_status_transaksi='1',trans_waktu_panggil='$trans_waktu_panggil',trans_id_loket='$Loket', trans_id_user='".$this->session->userdata('admin_id')."'
              where trans_no_ticket='$next_id' and trans_id_group_layanan IN (".join(',', $listlayanan).") and trans_tanggal_transaksi='$trans_tanggal_transaksi'");
        */

        $sql = $this->db->query("UPDATE anf_transaksi 
		  	set  trans_status_transaksi='1',trans_waktu_panggil='$trans_waktu_panggil',trans_id_loket='$Loket', trans_id_user='" . $this->session->userdata('admin_id') . "'
		  	where trans_no_ticket_awal = '$no_tiket_awal' and trans_no_ticket='$next_id' and trans_id_group_layanan IN (" . join(',', $listlayanan) . ") and trans_tanggal_transaksi='$trans_tanggal_transaksi'");

        if ($_countmk3['trans_tanggal_transaksi'] > '0') {
            $sql = $this->db->query("UPDATE anf_transaksi 
		  	set trans_waktu_finish='$waktu_finish', trans_status_transaksi='5' 
		  	where trans_no_ticket_awal='$_countmk3[trans_no_ticket_awal]' and trans_no_ticket='$_countmk3[trans_no_ticket]' and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi' ");

            $lay_id_layanan_forward = $daftarlayanan[$_countmk3['trans_id_layanan']]['lay_id_layanan_forward'];

            if (!empty($lay_id_layanan_forward)) {
                $vItems = array(
                    'trans_tanggal_transaksi' => $trans_tanggal_transaksi,
                    'trans_waktu_ambil' => $trans_waktu_panggil,
                    'trans_no_ticket_awal' => $_countmk3['trans_no_ticket_awal'],
                    'trans_no_ticket' => $_countmk3['trans_no_ticket'],
                    'id_layanan' => $lay_id_layanan_forward,
                    'id_group_layanan' => $daftarlayanan[$lay_id_layanan_forward]['lay_id_group_layanan'],
                );

                $sql = $this->db->query("INSERT INTO anf_transaksi (trans_tanggal_transaksi,trans_waktu_ambil,trans_no_ticket_awal,trans_no_ticket,trans_id_layanan,trans_id_group_layanan) 
		  VALUES ('$vItems[trans_tanggal_transaksi]', '$vItems[trans_waktu_ambil]','$vItems[trans_no_ticket_awal]', '$vItems[trans_no_ticket]','$vItems[id_layanan]','$vItems[id_group_layanan]')");
            }
        } else {
            //close cek layanan forward------------------------------------------------------------------------------
        }

    }

    function fnSkip()
    {
        $result = array(
            'success' => true,
        );

        $trans_tanggal_transaksi = date('Ymd');
        $trans_waktu_panggil = date("H:i:s");

        $Loket = $this->_data['cookie_loket_id'];

        $q = 'SELECT prilay_id_group_layanan 
		FROM anf_lokets 
		JOIN anf_prioritas_layanan ON (lokets_grolok_id = prilay_id_group_loket) 
		WHERE lokets_id = ' . $Loket;

        $query = $this->db->query($q);
        $listlayanan = array();
        foreach ($query->result() as $vRow) {
            $listlayanan[] = $vRow->prilay_id_group_layanan;
        }

        $scheduleCondition = $this->getScheduleCondition($listlayanan);

        $ct_id_lay = $this->db->query("SELECT trans_tanggal_transaksi,trans_no_ticket_awal,trans_no_ticket,grolay_nama_group_layanan,trans_waktu_panggil,trans_id_layanan,trans_id_group_layanan 
			from anf_transaksi JOIN anf_group_layanan ON trans_id_group_layanan=grolay_id_group_layanan 
			where trans_status_transaksi IN (1,2) and trans_id_group_layanan IN (" . join(',', $listlayanan) . ") and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi' ".$scheduleCondition." 
			order by trans_id_transaksi desc ");
        $_countmk3 = $ct_id_lay->row_array();

        $sql = $this->db->query("UPDATE anf_transaksi 
			set  trans_status_transaksi='3' 
			where trans_no_ticket_awal='$_countmk3[trans_no_ticket_awal]' and trans_no_ticket='$_countmk3[trans_no_ticket]' and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi'");

        echo json_encode($result);
    }

    function uploadWebCam() {
        $fileName = '';
        $tempName = '';
        $file_idx = '';
        
        $file_idx = 'file';
        $fileName = $_POST['video-filename'];
        $tempName = $_FILES[$file_idx]['tmp_name'];
        
        if (empty($fileName) || empty($tempName)) {
            if(empty($tempName)) {
                echo 'Invalid temp_name: '.$tempName;
                return;
            }

            echo 'Invalid file name: '.$fileName;
            return;
        }

        $filePath = 'assets/frontend/upload_video/' . $fileName;
        
        // make sure that one can upload only allowed audio/video files
        $allowed = array(
            'webm',
            'wav',
            'mp4',
            "mkv",
            'mp3',
            'ogg'
        );
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        if($extension == 'x-matroska') {
            $extension = 'mkv';
            $fileName = str_replace('x-matroska', 'mkv', $fileName);
            $filePath = 'assets/frontend/upload_video/' . $fileName;
        }

        if (!$extension || empty($extension) || !in_array($extension, $allowed)) {
            echo 'Invalid file extension: '.$extension;
            return;
        }
        
        if (!move_uploaded_file($tempName, $filePath)) {
            if(!empty($_FILES["file"]["error"])) {
                $listOfErrors = array(
                    '1' => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
                    '2' => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
                    '3' => 'The uploaded file was only partially uploaded.',
                    '4' => 'No file was uploaded.',
                    '6' => 'Missing a temporary folder. Introduced in PHP 5.0.3.',
                    '7' => 'Failed to write file to disk. Introduced in PHP 5.1.0.',
                    '8' => 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.'
                );
                $error = $_FILES["file"]["error"];

                if(!empty($listOfErrors[$error])) {
                    echo $listOfErrors[$error];
                }
                else {
                    echo 'Not uploaded because of error #'.$_FILES["file"]["error"];
                }
            }
            else {
                echo 'Problem saving file: '.$tempName;
            }
            return;
        }
        
        echo 'success';
    }

    function fnUndo($trans_id_transaksi = '')
    {
        $trans_id_transaksi = $this->input->post('id');

        $result = array(
            'success' => true,
        );

        $sql = $this->db->query("UPDATE anf_transaksi 
	  	set  trans_status_transaksi='0', trans_id_loket='' 
	  	where trans_id_transaksi = '$trans_id_transaksi' ");

        echo json_encode($result);
    }

    function fnforward($id_layanan, $id_group_layanan)
    {
        $id_layanan = $this->input->post('id_layanan');
        $id_group_layanan = $this->input->post('id_group_layanan');

        $result = array(
            'success' => true,
        );

        $Loket = $this->_data['cookie_loket_id'];

        $tmp = date('Ymd H:i:s');
        $tmpdate = explode(' ', $tmp);
        $currentDate = $tmpdate[0];
        $currentTime = $tmpdate[1];
        $waktu_finish = $tmpdate[1];

        $vItems = array(
            'trans_tanggal_transaksi' => $currentDate,
            'trans_waktu_ambil' => $currentTime,
            'trans_no_ticket_awal' => '',
            'trans_no_ticket' => '',
            'id_layanan' => $id_layanan,
            'id_group_layanan' => $id_group_layanan,
            'trans_nama_file' => '',
        );

        $q = 'SELECT prilay_id_group_layanan, prilay_id_group_loket 
		FROM anf_lokets JOIN anf_prioritas_layanan ON (lokets_grolok_id = prilay_id_group_loket) 
		WHERE lokets_id = ' . $Loket;

        $query = $this->db->query($q);
        $listlayanan = array();
        $grouploket = '';
        foreach ($query->result() as $vRow) {
            $listlayanan[] = $vRow->prilay_id_group_layanan;
            $grouploket = $vRow->prilay_id_group_loket;
        }

        $scheduleCondition = $this->getScheduleCondition($listlayanan);

        $q = 'SELECT grolay_nama_group_layanan, trans_id_transaksi, trans_no_ticket, trans_waktu_ambil, trans_no_ticket_awal, trans_id_layanan, trans_id_group_layanan, trans_nama_file 
		FROM anf_transaksi JOIN anf_group_layanan ON (trans_id_group_layanan = grolay_id_group_layanan) 
		JOIN anf_prioritas_layanan ON (trans_id_group_layanan = prilay_id_group_layanan) 
		WHERE prilay_id_group_loket = (' . $grouploket . ') AND trans_id_group_layanan IN (' . join(',', $listlayanan) . ') AND trans_status_transaksi IN (1,2) AND trans_tanggal_transaksi = "' . $currentDate . '" '.$scheduleCondition.' 
		ORDER BY prilay_prioritas ASC, trans_id_transaksi LIMIT 1';

        $query = $this->db->query($q);

        $trans_id_transaksi = '';
        foreach ($query->result() as $vRow) {
            $trans_id_transaksi = $vRow->trans_id_transaksi;
            $vItems['trans_no_ticket_awal'] = $vRow->trans_no_ticket_awal;
            $vItems['trans_no_ticket'] = $vRow->trans_no_ticket;
            $vItems['trans_nama_file'] = $vRow->trans_nama_file;
        }

        $sql = $this->db->query("UPDATE anf_transaksi 
			set trans_waktu_finish='$waktu_finish', trans_status_transaksi='5', trans_id_user='" . $this->session->userdata('admin_id') . "', trans_id_loket = " . $Loket . " where trans_id_transaksi=" . $trans_id_transaksi);

        $sql = $this->db->query("INSERT INTO anf_transaksi (trans_tanggal_transaksi,trans_waktu_ambil,trans_no_ticket_awal,trans_no_ticket,trans_id_layanan,trans_id_group_layanan,trans_nama_file) 
	  VALUES ('$vItems[trans_tanggal_transaksi]', '$vItems[trans_waktu_ambil]','$vItems[trans_no_ticket_awal]', '$vItems[trans_no_ticket]','$vItems[id_layanan]','$vItems[id_group_layanan]','$vItems[trans_nama_file]')");

        echo json_encode($result);
    }

    function fnRecall()
    {
        $result = array(
            'success' => true,
        );

        $trans_tanggal_transaksi = date('Ymd');
        $trans_waktu_panggil = date("H:i:s");

        $Loket = $this->_data['cookie_loket_id'];

        $q = 'SELECT prilay_id_group_layanan 
		FROM anf_lokets 
		JOIN anf_prioritas_layanan ON (lokets_grolok_id = prilay_id_group_loket) 
		WHERE lokets_id = ' . $Loket;

        $query = $this->db->query($q);
        $listlayanan = array();
        foreach ($query->result() as $vRow) {
            $listlayanan[] = $vRow->prilay_id_group_layanan;
        }

        $scheduleCondition = $this->getScheduleCondition($listlayanan);

        $ct_id_lay = $this->db->query("SELECT trans_tanggal_transaksi,trans_no_ticket_awal,trans_no_ticket,grolay_nama_group_layanan,trans_waktu_panggil,trans_id_layanan,trans_id_group_layanan 
			from anf_transaksi JOIN anf_group_layanan ON trans_id_group_layanan=grolay_id_group_layanan 
			where trans_status_transaksi IN (1,2) and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi' ".$scheduleCondition." 
			order by trans_id_transaksi desc ");
        $_countmk3 = $ct_id_lay->row_array();

        $sql = $this->db->query("UPDATE anf_transaksi 
			set  trans_status_transaksi='1' 
			where trans_no_ticket_awal='$_countmk3[trans_no_ticket_awal]' and trans_no_ticket='$_countmk3[trans_no_ticket]' and trans_id_loket='$Loket' and trans_tanggal_transaksi='$trans_tanggal_transaksi'");

        echo json_encode($result);

    }

    private function convertDateToDayName($currentDate = '')
    {
        if (empty($currentDate)) return false;
        $arrDay = [
            'minggu',
            'senin',
            'selasa',
            'rabu',
            'kamis',
            'jumat',
            'sabtu',
        ];
        $dayNo = date('w', strtotime($currentDate));
        return (!empty($arrDay[$dayNo]) ? $arrDay[$dayNo] : '');
    }

    private function getScheduleLayanan($idLayanan = '', $currentDate = '')
    {
        if (empty($idLayanan)) return false;
        $currentDate = !empty($currentDate) ? $currentDate : date('Y-m-d H:i:s');
        $dayName = $this->convertDateToDayName($currentDate);
        $query = "SELECT schd_id_layanan, schd_schedule FROM anf_schedule WHERE schd_hari = '$dayName' AND schd_id_layanan IN ($idLayanan)";
        $res = $this->db->query($query)->result();
        if (!empty($res)) {
            $data = [];
            foreach ($res as $value) {
                $data[$value->schd_id_layanan] = json_decode($value->schd_schedule);
            }
            return $data;
        }
        return false;
    }

    private function isScheduleLayanan($data = null, $currentDate = '')
    {
        if (empty($data)) return false;
        $currentDate = !empty($currentDate) ? $currentDate : date('Y-m-d H:i:s');
        list($date, $time) = explode(' ', $currentDate);
        foreach ($data as $value) {
            if (empty($value->flag_active)) continue;
            if ($value->jam_awal_layanan <= $time AND $value->jam_akhir_layanan >= $time) {
                return true;
                break;
            }
        }
        return false;
    }

    private function getTimeTiketSchedule($idLayanan = null, $currentDate = '')
    {
        $currentDate = !empty($currentDate) ? $currentDate : date('Y-m-d H:i:s');
        $res = $this->getScheduleLayanan($idLayanan, $currentDate);
        if (!empty($res)) {
            list($date, $time) = explode(' ', $currentDate);
            $data = [];
            $cnt = 0;
            foreach ($res as $key => $value) {
                foreach ($value as $value2) {
                    if(empty($value2->flag_active)) continue;
                    if($value2->jam_awal_layanan <= $time AND $value2->jam_akhir_layanan >= $time) {
                        $data[$cnt] = [
                            'trans_id_layanan' => $key,
                            'jam_awal_tiket' => $value2->jam_awal_tiket,
                            'jam_akhir_tiket' => $value2->jam_akhir_tiket,
                        ];
                        $cnt++;
                    }
                }
            }
            return $data;
        }
        return false;
    }

    private function getNonActivedSchedule($idLayanan = null, $currentDate = '')
    {
        $currentDate = !empty($currentDate) ? $currentDate : date('Y-m-d H:i:s');
        $res = $this->getScheduleLayanan($idLayanan, $currentDate);
        if (!empty($res)) {
            list($date, $time) = explode(' ', $currentDate);
            $data = [];
            foreach ($res as $key => $value) {
                $cntTmp1 = 0;
                $cntTmp2 = 0;
                foreach ($value as $value2) {
                    if (empty($value2->flag_active)) continue;
                    if ($value2->jam_awal_layanan >= $time OR $value2->jam_akhir_layanan <= $time) $cntTmp2++;
                    $cntTmp1++;
                }
                if(!empty($cntTmp1) AND $cntTmp1 == $cntTmp2) $data[$key] = $key;
            }
            return $data;
        }
        return false;
    }

    private function isValidSchedule($idLayanan = null, $currentDate = '')
    {
        $currentDate = !empty($currentDate) ? $currentDate : date('Y-m-d H:i:s');
        $res = $this->getScheduleLayanan($idLayanan, $currentDate);
        if (!empty($res)) {
            foreach ($res as $value) {
                if (!$this->isScheduleLayanan($value, $currentDate)) continue;
                return true;
            }
        }
        return false;
    }

    private function getScheduleCondition($arrGroupLayanan = null, $currentDate = '')
    {
        if (empty($arrGroupLayanan)) return '';

        $idLayanan = $this->getListLayananFromGroupLayanan($arrGroupLayanan);
        if (empty($idLayanan)) return '';

        $text = '';
        $currentDate = !empty($currentDate) ? $currentDate : date('Y-m-d H:i:s');
        if ($this->isValidSchedule($idLayanan, $currentDate)) {
            $res = $this->getTimeTiketSchedule($idLayanan, $currentDate);
            if (!empty($res)) {
                $tmp = [];
                $tmp2 = [];
                foreach ($res as $key => $value) {
                    $tmp2[$value['trans_id_layanan']] = $value['trans_id_layanan'];
                    $tmp[] = "(anf_transaksi.trans_id_layanan = ".$value['trans_id_layanan']." AND anf_transaksi.trans_waktu_ambil >= '" . $value['jam_awal_tiket'] . "' AND anf_transaksi.trans_waktu_ambil <= '" . $value['jam_akhir_tiket'] . "')";
                }
                if (!empty($tmp)) {
                    $text = " AND (".join(' OR ', $tmp)." OR anf_transaksi.trans_id_layanan NOT IN (".join(',', $tmp2).")) ";
                }
            }
        }
        $res = $this->getNonActivedSchedule($idLayanan);
        if(!empty($res)) {
            $text .= " AND anf_transaksi.trans_id_layanan NOT IN (".join(',', $res).") ";
        }
        return $text;
    }

    private function getListLayananFromGroupLayanan($arrGroupLayanan = null)
    {
        if (empty($arrGroupLayanan)) return false;
        $query = "SELECT lay_id_layanan FROM anf_layanan WHERE lay_id_group_layanan IN (" . join(',', $arrGroupLayanan) . ")";
        $res = $this->db->query($query)->result();
        if (!empty($res)) {
            $tmp = [];
            foreach ($res as $value) {
                $tmp[$value->lay_id_layanan] = $value->lay_id_layanan;
            }
            if (!empty($tmp)) return join(',', $tmp);
        }
        return false;
    }

}

?>