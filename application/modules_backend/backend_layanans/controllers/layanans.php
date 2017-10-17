<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Layanans extends MY_Admin {
	private $_template 			= 'template_admin/main';
	private $_module_controller = 'backend_layanans/layanans/';
	private $_table_name 		= 'layanan';
	private $_table_field_pref 	= 'lay_';
	private $_table_pk 			= 'lay_id_layanan';
	private $_model_crud 		= 'layanans_model';

	private $_page_title 		= 'Antrian : Admin Layanan';
	private $_page_content_info	= array(
		'title' => 'Data Layanan',
		'desc' 	=> 'List Layanan',
	);

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin_id')) {
			redirect('backend_login/login');
			exit();
		}

		$this->load->model($this->_model_crud,'crudmodel');
	}

	private function get_additional_field() {
		$additional_field = array(
			array(
				'field_name' 			=> 'grolay_nama_group_layanan',
				'just_info' 			=> true,
			),
		);

		return $additional_field;
	}	

	private function get_show_column() {
		$column_list = array(
			array(
				'title_header_column' 	=> 'No.',
				'field_name' 			=> $this->_table_field_pref . 'id_layanan',
				'show_no_static' 		=> true,
				'no_order'				=> 0,
			),
			array(
				'title_header_column' 	=> 'Nama Layanan',
				'field_name' 			=> $this->_table_field_pref . 'nama_layanan',
				'no_order'				=> 1,
			),
			array(
				'title_header_column' 	=> 'Group Layanan',
				'field_name' 			=> 'grolay_nama_group_layanan',
				'no_order'				=> 2,
			),
			array(
				'title_header_column' 	=> 'Layanan Forward',
				'field_name' 			=> $this->_table_field_pref . 'id_layanan_forward',
				'no_order'				=> 3,
				'result_format'			=> function( $d, $row ) {
						$CI =& get_instance();
						$CI->load->model('layanans_model', 'layanansx');
						$res = $CI->layanansx->where(array('lay_id_layanan' => $d))->get_row();
						$res['lay_nama_layanan'] = !empty($res['lay_nama_layanan']) ? $res['lay_nama_layanan'] : '-';
			            return $res['lay_nama_layanan'];
			        },
			),
			array(
				'title_header_column' 	=> 'Action',
				'field_name' 			=> $this->_table_field_pref . 'id_layanan',
				'result_format'			=> function( $d, $row ) {
			            return '<a onclick="doFormEdit('.$d.');return false;" href="#" class="btn btn-xs btn-success">EDIT <i class="glyph-icon icon-pencil-square-o"></i></a> <a onclick="showModalBoxDelete('.$d.');return false;" href="#" class="btn btn-xs btn-danger">DELETE <i class="glyph-icon icon-close"></i></a>';
			        },
			    'no_order'				=> 4,
			),
		);

		return $column_list;
	}

	private function get_input_field_new($data_value = array()) {
		$this->load->model('grouplayanans_model','grouplayanans');
		$source_grouplayanan = $this->grouplayanans->get_option();

		$this->load->model('layanans_model','layanans');
		$source_layanan = $this->layanans->get_option();

		$this->load->model('waktulayanans_model','waktulayanans');
		$source_waktulayanan = $this->waktulayanans->get_option();

		$data_input = array(
			array(
				'db_field' 		=> $this->_table_field_pref . 'id_layanan',
				'db_pk' 		=> true,
				'db_process'	=> false,
				'data_edit'		=> array(
					'db_process'		=> false,
				),
			),
			array(
				'label' 		=> 'Nama Layanan',
				'db_field' 		=> $this->_table_field_pref . 'nama_layanan',
				'db_process'	=> true,
				'input_type'	=> 'text',
				'input_attr'	=> 'type="text" data-parsley-minlength="1" class="form-control" placeholder="Nama Layanan..."',
				'required'		=> 'required',
				'data_source'	=> '',
				'data_edit'		=> array(
					'db_process'	=> true,
					'required'		=> 'required',
				),
			),
			array(
				'label' 		=> 'Group Layanan',
				'db_field' 		=> $this->_table_field_pref . 'id_group_layanan',
				'db_process'	=> true,
				'input_type'	=> 'select',
				'input_attr'	=> 'type="text" data-parsley-minlength="1" class="form-control" placeholder="Group Layanan..."',
				'data_source'	=> $source_grouplayanan,
				'data_edit'		=> array(
					'db_process'	=> true,
				),
			),
			array(
				'label' 		=> 'Layanan Forward',
				'db_field' 		=> $this->_table_field_pref . 'id_layanan_forward',
				'db_process'	=> true,
				'input_type'	=> 'select',
				'input_attr'	=> 'type="text" data-parsley-minlength="1" class="form-control" placeholder="Layanan Forward..."',
				'data_source'	=> $source_layanan,
				'data_edit'		=> array(
					'db_process'	=> true,
				),
			),
			array(
				'label' 		=> 'Waktu Layanan',
				'db_field' 		=> $this->_table_field_pref . 'id_waktu_layanan',
				'db_process'	=> true,
				'input_type'	=> 'select',
				'input_attr'	=> 'type="text" data-parsley-minlength="1" class="form-control" placeholder="Layanan Forward..."',
				'data_source'	=> $source_waktulayanan,
				'data_edit'		=> array(
					'db_process'	=> true,
				),
			),
			array(
				'label' 		=> 'Stok',
				'db_field' 		=> $this->_table_field_pref . 'stok',
				'db_process'	=> true,
				'input_type'	=> 'text',
				'input_attr'	=> 'type="text" class="form-control" placeholder="Stok..."',
				'data_source'	=> '',
				'data_edit'		=> array(
					'db_process'	=> true,
				),
			),
			array(
				'label' 		=> 'Estimasi',
				'db_field' 		=> $this->_table_field_pref . 'estimasi',
				'db_process'	=> true,
				'input_type'	=> 'text',
				'input_attr'	=> 'type="text" class="form-control" placeholder="Estimasi..."',
				'data_source'	=> '',
				'data_edit'		=> array(
					'db_process'	=> true,
				),
			),
			array(
				'label' 		=> 'Keterangan',
				'db_field' 		=> $this->_table_field_pref . 'keterangan',
				'db_process'	=> true,
				'input_type'	=> 'textarea',
				'input_attr'	=> 'class="form-control" placeholder="Keterangan..."',
				'data_source'	=> '',
				'data_edit'		=> array(
					'db_process'	=> true,
				),
			),
			array(
				'label' 		=> 'Layanan Status Aktif',
				'db_field' 		=> $this->_table_field_pref . 'layanan_status',
				'db_process'	=> true,
				'input_type'	=> 'checkbox',
				'input_attr'	=> '',
				'data_source'	=> '',
				'data_edit'		=> array(
					'db_process'	=> true,
				),
			),
			array(
				'label' 		=> 'Popup Status Aktif',
				'db_field' 		=> $this->_table_field_pref . 'status_popup',
				'db_process'	=> true,
				'input_type'	=> 'checkbox',
				'input_attr'	=> '',
				'data_source'	=> '',
				'data_edit'		=> array(
					'db_process'	=> true,
				),
			),
            array(
                'label' 		=> 'Parent',
                'db_field' 		=> $this->_table_field_pref . 'parent_id',
                'db_process'	=> true,
                'input_type'	=> 'select',
                'input_attr'	=> 'class="form-control"',
                'data_source'	=> $source_layanan,
                'data_edit'		=> array(
                    'db_process'		=> true,
                ),
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

	//--- used by datatable source data -------
	function lists_ajax() {
		$this->load->helper('mydatatable');
		$table 		= $this->db->dbprefix . $this->_table_name;
		$table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'group_layanan ON (lay_id_group_layanan = grolay_id_group_layanan) ';
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

				if(!empty($value['input_type']) AND $value['input_type'] == 'checkbox') {
					$admin_data[$value['db_field']] = !empty($admin_data[$value['db_field']]) ? 1 : 0;
				}
			}
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

		$this->_data['ajax_action_edit'] 	= site_url($this->_module_controller . 'do_edit_ajax');
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

				if(!empty($value['input_type']) AND $value['input_type'] == 'checkbox') {
					$admin_data[$value['db_field']] = !empty($admin_data[$value['db_field']]) ? 1 : 0;
				}
			}

			if(!empty($value['db_pk']) AND $value['db_pk']) {
				$user_id = $this->input->post($value['db_field']);
				$field_pk 	= $value['db_field'];
			}
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