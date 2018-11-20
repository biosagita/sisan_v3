<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visitors extends MY_Admin {
	private $_template 			= 'template_admin/main';
	private $_module_controller = 'backend_visitors/visitors/';
	private $_table_name 		= 'master_profile';
	private $_table_field_pref 	= '';
	private $_table_pk 			= 'id_profile';
	private $_model_crud 		= 'visitors_model';

	private $_page_title 		= 'Antrian : Admin Visitor';
	private $_page_content_info	= array(
		'title' => 'Data Visitor',
		'desc' 	=> 'List Visitor',
	);

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin_id')) {
			redirect('backend_login/login');
			exit();
		}

		$this->db->dbprefix = 't_';

		$this->load->model($this->_model_crud,'crudmodel');
	}

	private function get_show_column() {
		$column_list = array(
			array(
				'title_header_column' 	=> 'No.',
				'field_name' 			=> $this->_table_field_pref . 'id_profile',
				'show_no_static' 		=> true,
				'no_order'				=> 0,
			),
			array(
				'title_header_column' 	=> 'NIK',
				'field_name' 			=> $this->_table_field_pref . 'nuptk',
				'no_order'				=> 1,
			),
			array(
				'title_header_column' 	=> 'Nama Lengkap',
				'field_name' 			=> $this->_table_field_pref . 'nama',
				'no_order'				=> 2,
			),
			array(
				'title_header_column' 	=> 'Jenis Kelamin',
				'field_name' 			=> $this->_table_field_pref . 'jenis_kelamin',
				'no_order'				=> 3,
				'result_format'			=> function( $d, $row ) {
                    $res = '';
                    if($row['jenis_kelamin'] == 'L') $res = 'Laki-laki';
                    if($row['jenis_kelamin'] == 'P') $res = 'Perempuan';
                    return $res;
                },
			),
			array(
				'title_header_column' 	=> 'Action',
				'field_name' 			=> $this->_table_field_pref . 'id_profile',
				'result_format'			=> function( $d, $row ) {
			            return '<a onclick="doFormEdit('.$d.');return false;" href="#" class="btn btn-xs btn-success">EDIT <i class="glyph-icon icon-pencil-square-o"></i></a> <a onclick="showModalBoxDelete('.$d.');return false;" href="#" class="btn btn-xs btn-danger">DELETE <i class="glyph-icon icon-close"></i></a>';
			        },
			    'no_order'				=> 4,
			),
		);

		return $column_list;
	}

	private function get_input_field_new($data_value = array()) {
		$source_jenis_kelamin = [
			[
				'name' => 'Laki-laki',
				'value' => 'L',
			],
			[
				'name' => 'Perempuan',
				'value' => 'P',
			]
		];

		$source_pendidikan_terakhir = [
			[
				'name' => 'SD',
				'value' => 'SD',
			],
			[
				'name' => 'SMP',
				'value' => 'SMP',
			],
			[
				'name' => 'SMA',
				'value' => 'SMA',
			],
			[
				'name' => 'D1',
				'value' => 'D1',
			],
			[
				'name' => 'D3',
				'value' => 'D3',
			],
			[
				'name' => 'S1',
				'value' => 'S1',
			],
			[
				'name' => 'S2',
				'value' => 'S2',
			],
		];

		$source_propinsi = [];
		$q = 'SELECT id_prov, prov FROM t_master_wilayah GROUP BY id_prov ORDER BY prov';
        $res = $this->db->query($q);
        $resRow = $res->result_array();
        if(!empty($resRow)) {
        	foreach ($resRow as $key => $value) {
        		$source_propinsi[] = [
        			'name' => $value['prov'], 
        			'value' => $value['id_prov'], 
        		];
        	}
        }

		$source_kabupaten = [];
		/*$q = 'SELECT id_prov, id_kab, kab FROM t_master_wilayah GROUP BY id_kab ORDER BY kab';
        $res = $this->db->query($q);
        $resRow = $res->result_array();
        if(!empty($resRow)) {
        	foreach ($resRow as $key => $value) {
        		$source_kabupaten[] = [
        			'name' => $value['kab'], 
        			'value' => $value['id_kab'], 
        			'other' => $value['id_prov'], 
        		];
        	}
        }*/

		$source_kecamatan = [];
		/*$q = 'SELECT id_kab, id_kec, kec FROM t_master_wilayah GROUP BY id_kec ORDER BY kec';
        $res = $this->db->query($q);
        $resRow = $res->result_array();
        if(!empty($resRow)) {
        	foreach ($resRow as $key => $value) {
        		$source_kecamatan[] = [
        			'name' => $value['kec'], 
        			'value' => $value['id_kec'], 
        			'other' => $value['id_kab'],
        		];
        	}
        }*/

		$source_kelurahan = [];
		/*$q = 'SELECT id_kec, id_desa, desa FROM t_master_wilayah GROUP BY id_desa ORDER BY desa';
        $res = $this->db->query($q);
        $resRow = $res->result_array();
        if(!empty($resRow)) {
        	foreach ($resRow as $key => $value) {
        		$source_kelurahan[] = [
        			'name' => $value['desa'], 
        			'value' => $value['id_desa'], 
        			'other' => $value['id_kec'],
        		];
        	}
        }*/

		$data_input = array(
			array(
				'db_field' 		=> $this->_table_field_pref . 'id_profile',
				'db_pk' 		=> true,
				'db_process'	=> false,
				'data_edit'		=> array(
					'db_process'		=> false,
				),
			),
			array(
				'label' 		=> 'NIK',
				'db_field' 		=> $this->_table_field_pref . 'nuptk',
				'db_process'	=> true,
				'input_type'	=> 'text',
				'input_attr'	=> 'type="text" class="form-control" placeholder="Company Name..."',
				'data_source'	=> '',
				'data_edit'		=> array(
					'db_process'	=> true,
				),
			),
			array(
				'label' 		=> 'Nama Lengkap',
				'db_field' 		=> $this->_table_field_pref . 'nama',
				'db_process'	=> true,
				'input_type'	=> 'text',
				'input_attr'	=> 'type="text" data-parsley-minlength="1" class="form-control" placeholder="Company Name..."',
				'required'		=> 'required',
				'data_source'	=> '',
				'data_edit'		=> array(
					'db_process'	=> true,
				),
			),
			array(
				'label' 		=> 'Alamat',
				'db_field' 		=> $this->_table_field_pref . 'alamat',
				'db_process'	=> true,
				'input_type'	=> 'textarea',
				'input_attr'	=> 'type="text" class="form-control" placeholder="Alamat..."',
				'data_source'	=> '',
				'data_edit'		=> array(
					'db_process'	=> true,
				),
			),
			array(
				'label' 		=> 'Jenis Kelamin',
				'db_field' 		=> $this->_table_field_pref . 'jenis_kelamin',
				'db_process'	=> true,
				'input_type'	=> 'select',
				'input_attr'	=> 'type="text" class="form-control" placeholder="Jenis Kelamin..."',
				'data_source'	=> $source_jenis_kelamin,
				'data_edit'		=> array(
					'db_process'	=> true,
				),
			),
			array(
				'label' 		=> 'Pendidikan Terakhir',
				'db_field' 		=> $this->_table_field_pref . 'bentuk_pendidikan',
				'db_process'	=> true,
				'input_type'	=> 'select',
				'input_attr'	=> 'type="text" class="form-control" placeholder="Pendidikan Terakhir..."',
				'data_source'	=> $source_pendidikan_terakhir,
				'data_edit'		=> array(
					'db_process'	=> true,
				),
			),
			array(
				'label' 		=> 'Pekerjaan',
				'db_field' 		=> $this->_table_field_pref . 'pekerjaan_lainnya',
				'db_process'	=> true,
				'input_type'	=> 'text',
				'input_attr'	=> 'type="text" class="form-control" placeholder="Pekerjaan..."',
				'data_source'	=> '',
				'data_edit'		=> array(
					'db_process'	=> true,
				),
			),
			array(
				'label' 		=> 'Email',
				'db_field' 		=> $this->_table_field_pref . 'email',
				'db_process'	=> true,
				'input_type'	=> 'text',
				'input_attr'	=> 'type="text" class="form-control" placeholder="Email..."',
				'data_source'	=> '',
				'data_edit'		=> array(
					'db_process'	=> true,
				),
			),
			array(
				'label' 		=> 'No. Handphone',
				'db_field' 		=> $this->_table_field_pref . 'no_telp',
				'db_process'	=> true,
				'input_type'	=> 'text',
				'input_attr'	=> 'type="text" class="form-control" placeholder="No. Handphone..."',
				'data_source'	=> '',
				'data_edit'		=> array(
					'db_process'	=> true,
				),
			),
			array(
				'label' 		=> 'Propinsi',
				'db_field' 		=> $this->_table_field_pref . 'propinsi',
				'input_type'	=> 'select',
				'input_attr'	=> 'type="text" class="form-control" placeholder="Propinsi..."',
				'data_source'	=> $source_propinsi,
			),
			array(
				'label' 		=> 'Kabupaten / Kota',
				'db_field' 		=> $this->_table_field_pref . 'kabupaten',
				'input_type'	=> 'select',
				'input_attr'	=> 'type="text" class="form-control" placeholder="Kabupaten..."',
				'data_source'	=> $source_kabupaten,
			),
			array(
				'label' 		=> 'Kecamatan',
				'db_field' 		=> $this->_table_field_pref . 'kecamatan',
				'input_type'	=> 'select',
				'input_attr'	=> 'type="text" class="form-control" placeholder="Kecamatan..."',
				'data_source'	=> $source_kecamatan,
			),
			array(
				'label' 		=> 'Kelurahan / Desa',
				'db_field' 		=> $this->_table_field_pref . 'kelurahan',
				'input_type'	=> 'select',
				'input_attr'	=> 'type="text" class="form-control" placeholder="Kelurahan..."',
				'data_source'	=> $source_kelurahan,
			),
		);

		if(!empty($data_value)) {
			foreach ($data_input as $key => $value) {
				if(!empty($data_input[$key]['data_edit']['input_empty']) AND $data_input[$key]['data_edit']['input_empty']) {
					$data_input[$key]['data_edit']['input_value'] = '';
				} else {
					$data_input[$key]['data_edit']['input_value'] = !empty($data_value[$data_input[$key]['db_field']]) ? $data_value[$data_input[$key]['db_field']] : '';
				}
			}
		}

		return $data_input;
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
		$this->_data['page_content_ajax'] 	= site_url($this->_module_controller . 'page_content_ajax');
		$this->_data['ajax_lists'] 			= site_url($this->_module_controller . 'lists_ajax');
		$this->_data['ajax_form_add'] 		= site_url($this->_module_controller . 'add_ajax');
		$this->_data['ajax_form_edit'] 		= site_url($this->_module_controller . 'edit_ajax');
		$this->_data['ajax_action_delete'] 	= site_url($this->_module_controller . 'do_delete_ajax');

		$this->_data['column_list'] = $this->get_show_column();

		$this->_data['info_page'] = $this->_page_content_info;

		$this->load->view('lists', $this->_data);
	}

	function ajax_kabupaten() {
		$data = '<option value="">-- Choose --</option>';

		$id_prov = $this->input->post('id_prov');
		$q = 'SELECT id_kab, kab FROM t_master_wilayah WHERE id_prov = "'.$id_prov.'" GROUP BY id_kab ORDER BY kab';
        $res = $this->db->query($q);
        $resRow = $res->result_array();
        if(!empty($resRow)) {
        	foreach ($resRow as $key => $value) {
        		$data .= '<option value="'.$value['id_kab'].'">';
        		$data .= $value['kab'];
        		$data .= '</option>';
        	}
        }
		echo $data;
	}

	function ajax_kecamatan() {
		$data = '<option value="">-- Choose --</option>';

		$id_prov = $this->input->post('id_prov');
		$id_kab = $this->input->post('id_kab');
		$q = 'SELECT id_kec, kec FROM t_master_wilayah WHERE id_prov = "'.$id_prov.'" AND id_kab = "'.$id_kab.'" GROUP BY id_kec ORDER BY kec';
        $res = $this->db->query($q);
        $resRow = $res->result_array();
        if(!empty($resRow)) {
        	foreach ($resRow as $key => $value) {
        		$data .= '<option value="'.$value['id_kec'].'">';
        		$data .= $value['kec'];
        		$data .= '</option>';
        	}
        }
		echo $data;
	}

	function ajax_kelurahan() {
		$data = '<option value="">-- Choose --</option>';

		$id_prov = $this->input->post('id_prov');
		$id_kab = $this->input->post('id_kab');
		$id_kec = $this->input->post('id_kec');
		$q = 'SELECT id_desa, desa FROM t_master_wilayah WHERE id_prov = "'.$id_prov.'" AND id_kab = "'.$id_kab.'" AND id_kec = "'.$id_kec.'" ORDER BY desa';
        $res = $this->db->query($q);
        $resRow = $res->result_array();
        if(!empty($resRow)) {
        	foreach ($resRow as $key => $value) {
        		$data .= '<option value="'.$value['id_desa'].'">';
        		$data .= $value['desa'];
        		$data .= '</option>';
        	}
        }
		echo $data;
	}

	//--- used by datatable source data -------
	function lists_ajax() {
		$this->load->helper('mydatatable');
		$table 		= $this->db->dbprefix . $this->_table_name;
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
			);
			$cnt++;
		}
		generateDataTable($table, $primaryKey, $columns);
	}

	function add_ajax() {
		$this->_data['ajax_action_add'] 	= site_url($this->_module_controller . 'do_add_ajax');
		$this->_data['ajax_kabupaten'] 	= site_url($this->_module_controller . 'ajax_kabupaten');
		$this->_data['ajax_kecamatan'] 	= site_url($this->_module_controller . 'ajax_kecamatan');
		$this->_data['ajax_kelurahan'] 	= site_url($this->_module_controller . 'ajax_kelurahan');
		$this->_data['input_list'] 			= $this->get_input_field_new();
		$this->load->view('form_add', $this->_data);
	}

	function do_add() {
		$this->load->library('form_validation');

		$table_name 		= $this->_table_name;
		$input_list = $this->get_input_field_new();
		$admin_data = array();

		foreach ($input_list as $key => $value) {
			if(!empty($value['db_process']) AND $value['db_process']) {
				if(!empty($value['required'])) {
					$this->form_validation->set_rules($value['db_field'], $value['label'], 'trim|htmlspecialchars|encode_php_tags|prep_for_form|required|xss_clean');

					if(!empty($value['data_unique']) AND $value['data_unique']) {
						$tmp_unique = $table_name . '.' . $value['db_field'];
						$this->form_validation->set_rules($value['db_field'], $value['label'], 'is_unique['.$tmp_unique.']');
					}
				}

				$admin_data[$value['db_field']] = $this->input->post($value['db_field']);
				if(!empty($value['data_md5']) AND $value['data_md5']) {
					$admin_data[$value['db_field']] = md5($this->input->post($value['db_field']));
				}
			}
		}

		$propinsi = $this->input->post('propinsi');
		$kabupaten = $this->input->post('kabupaten');
		$kecamatan = $this->input->post('kecamatan');
		$kelurahan = $this->input->post('kelurahan');
		if(!empty($propinsi) AND !empty($kabupaten) AND !empty($kecamatan) AND !empty($kelurahan)) {
			$q = 'SELECT id_wilayah FROM t_master_wilayah WHERE id_prov = "'.$propinsi.'" AND id_kab = "'.$kabupaten.'" AND id_kec = '.$kecamatan.' AND id_desa = "'.$kelurahan.'"';
	        $res = $this->db->query($q);
	        $resRow = $res->row_array();
	        if(!empty($resRow)) $admin_data['id_wilayah'] = $resRow['id_wilayah'];

	        $q = 'SELECT prov FROM t_master_wilayah WHERE id_prov = "'.$propinsi.'" LIMIT 1';
	        $res = $this->db->query($q);
	        $resRow = $res->row_array();
	        if(!empty($resRow)) $admin_data['Propinsi'] = $resRow['prop'];

	        $q = 'SELECT kab FROM t_master_wilayah WHERE id_kab = "'.$kabupaten.'" LIMIT 1';
	        $res = $this->db->query($q);
	        $resRow = $res->row_array();
	        if(!empty($resRow)) $admin_data['kabupaten'] = $resRow['kab'];

	        $q = 'SELECT kec FROM t_master_wilayah WHERE id_kec = "'.$kecamatan.'" LIMIT 1';
	        $res = $this->db->query($q);
	        $resRow = $res->row_array();
	        if(!empty($resRow)) $admin_data['kecamatan'] = $resRow['kec'];

	        $q = 'SELECT desa FROM t_master_wilayah WHERE id_desa = "'.$kelurahan.'" LIMIT 1';
	        $res = $this->db->query($q);
	        $resRow = $res->row_array();
	        if(!empty($resRow)) $admin_data['kelurahan'] = $resRow['desa'];
		}
		
		if($this->form_validation->run()) {
			$res = false;
			if(!empty($admin_data)) {
				$res = $this->crudmodel->posts($admin_data);
				if($res) {
					$this->_data['success_msg'] = 'Insert data success.';
				} else {
					$this->_data['err_msg'] = 'Insert data failed. Please try again.';
				}
			} else {
				$this->_data['err_msg'] = 'Data is empty.';
			}
			return $res;
		} else {
			$this->_data['err_msg'] = validation_errors();
			return FALSE;
		}
	}

	function do_add_ajax() {
		$res = array(
			'err_msg' 		=> '',
			'success_msg' 	=> '',
		);

		if(!$this->do_add()) $res['err_msg'] = $this->_data['err_msg'];
		$res['success_msg'] = !empty($this->_data['success_msg']) ? $this->_data['success_msg'] : '';

		echo json_encode($res);
	}

	function edit_ajax() {
		$data_id = $this->input->post('data_id');
		$data = $this->crudmodel->where(array($this->_table_pk => $data_id ))->get_login();
		$this->_data['data_row'] = $data;

		$this->_data['input_list'] 			= $this->get_input_field_new($data);

		$this->_data['wilayah'] = [];
		if(!empty($data['id_wilayah'])) {
			$q = 'SELECT * FROM t_master_wilayah WHERE id_wilayah = "'.$data['id_wilayah'].'" LIMIT 1';
	        $res = $this->db->query($q);
	        $resRow = $res->row_array();
	        if(!empty($resRow)) $this->_data['wilayah'] = $resRow;
		}

		$this->_data['ajax_action_edit'] 	= site_url($this->_module_controller . 'do_edit_ajax');
		$this->_data['ajax_kabupaten'] 	= site_url($this->_module_controller . 'ajax_kabupaten');
		$this->_data['ajax_kecamatan'] 	= site_url($this->_module_controller . 'ajax_kecamatan');
		$this->_data['ajax_kelurahan'] 	= site_url($this->_module_controller . 'ajax_kelurahan');

		$this->load->view('form_edit', $this->_data);
	}

	function do_edit() {
		$this->load->library('form_validation');

		$input_list = $this->get_input_field_new();
		$admin_data = array();
		$user_id 	= '';
		$field_pk 	= '';

		foreach ($input_list as $key => $value) {
			if(!empty($value['same_related'])) {
				$tmp = $this->input->post($value['same_related']);
				if($tmp != $this->input->post($value['db_field'])) {
					$this->form_validation->set_rules($value['db_field'], $value['label'], 'trim|htmlspecialchars|encode_php_tags|prep_for_form|required|xss_clean');
				}
			}

			if(!empty($value['data_edit']['db_process']) AND $value['data_edit']['db_process']) {
				if(!empty($value['data_edit']['required'])) {
					$this->form_validation->set_rules($value['db_field'], $value['label'], 'trim|htmlspecialchars|encode_php_tags|prep_for_form|required|xss_clean');
				} else {
					$this->form_validation->set_rules($value['db_field'], $value['label'], 'trim|htmlspecialchars|encode_php_tags|prep_for_form|xss_clean');
				}

				if(!empty($value['data_edit']['input_disabled'])) continue;

				$post_value = $this->input->post($value['db_field']);
				if(empty($post_value) AND !empty($value['data_edit']['ignore_empty'])) continue;

				$admin_data[$value['db_field']] = $post_value;
				if(!empty($value['data_md5']) AND $value['data_md5']) {
					$admin_data[$value['db_field']] = md5($post_value);
				}
			}

			if(!empty($value['db_pk']) AND $value['db_pk']) {
				$user_id = $this->input->post($value['db_field']);
				$field_pk 	= $value['db_field'];
			}
		}

		$propinsi = $this->input->post('propinsi');
		$kabupaten = $this->input->post('kabupaten');
		$kecamatan = $this->input->post('kecamatan');
		$kelurahan = $this->input->post('kelurahan');
		if(!empty($propinsi) AND !empty($kabupaten) AND !empty($kecamatan) AND !empty($kelurahan)) {
			$q = 'SELECT id_wilayah FROM t_master_wilayah WHERE id_prov = "'.$propinsi.'" AND id_kab = "'.$kabupaten.'" AND id_kec = '.$kecamatan.' AND id_desa = "'.$kelurahan.'"';
	        $res = $this->db->query($q);
	        $resRow = $res->row_array();
	        if(!empty($resRow)) $admin_data['id_wilayah'] = $resRow['id_wilayah'];

	        $q = 'SELECT prov FROM t_master_wilayah WHERE id_prov = "'.$propinsi.'" LIMIT 1';
	        $res = $this->db->query($q);
	        $resRow = $res->row_array();
	        if(!empty($resRow)) $admin_data['Propinsi'] = $resRow['prov'];

	        $q = 'SELECT kab FROM t_master_wilayah WHERE id_prov = "'.$propinsi.'" AND id_kab = "'.$kabupaten.'" LIMIT 1';
	        $res = $this->db->query($q);
	        $resRow = $res->row_array();
	        if(!empty($resRow)) $admin_data['kabupaten'] = $resRow['kab'];

	        $q = 'SELECT kec FROM t_master_wilayah WHERE id_prov = "'.$propinsi.'" AND id_kab = "'.$kabupaten.'" AND id_kec = "'.$kecamatan.'" LIMIT 1';
	        $res = $this->db->query($q);
	        $resRow = $res->row_array();
	        if(!empty($resRow)) $admin_data['kecamatan'] = $resRow['kec'];

	        $q = 'SELECT desa FROM t_master_wilayah WHERE id_prov = "'.$propinsi.'" AND id_kab = "'.$kabupaten.'" AND id_kec = "'.$kecamatan.'" AND id_desa = "'.$kelurahan.'" LIMIT 1';
	        $res = $this->db->query($q);
	        $resRow = $res->row_array();
	        if(!empty($resRow)) $admin_data['kelurahan'] = $resRow['desa'];
		}
		
		if($this->form_validation->run()) {
			$res = false;
			if(empty($user_id) OR empty($field_pk)) {
				$this->_data['err_msg'] = 'user id or primary key is empty.';
				return $res;
			}

			if(!empty($admin_data)) {
				$res = $this->crudmodel->where(array($field_pk => $user_id))->puts($admin_data);
				if($res) {
					$this->_data['success_msg'] = 'Update data success.';
				} else {
					$this->_data['err_msg'] = 'Update data failed. Please try again.';
				}
			} else {
				$this->_data['err_msg'] = 'Data is empty.';
			}
			return $res;
		} else {
			$this->_data['err_msg'] = validation_errors();
			return FALSE;
		}
	}

	function do_edit_ajax() {
		$res = array(
			'err_msg' 		=> '',
			'success_msg' 	=> '',
		);

		if(!$this->do_edit()) $res['err_msg'] = $this->_data['err_msg'];
		$res['success_msg'] = !empty($this->_data['success_msg']) ? $this->_data['success_msg'] : '';

		echo json_encode($res);
	}

	function do_delete() {
		if($this->input->post('data_id')) {
			$delete = $this->crudmodel->delete(array($this->_table_pk => $this->input->post('data_id')));
			if($delete) {
				$this->_data['success_msg'] = 'Delete data success.';
			} else {
				$this->_data['err_msg'] = 'Delete data failed. Please try again.';
			}
			return $delete;
		} else {
			$this->_data['err_msg'] = 'Data is empty.';
			return false;
		}
	}

	function do_delete_ajax() {
		$res = array(
			'err_msg' 		=> '',
			'success_msg' 	=> '',
		);

		if(!$this->do_delete()) $res['err_msg'] = $this->_data['err_msg'];
		$res['success_msg'] = !empty($this->_data['success_msg']) ? $this->_data['success_msg'] : '';

		echo json_encode($res);
	}
	
}

?>