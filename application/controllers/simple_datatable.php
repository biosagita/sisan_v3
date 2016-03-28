<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simple_datatable extends CI_Controller {
	private $_table_name 		= 'adminuserlevel';
	private $_table_field_pref 	= 'aulv_';
	private $_table_pk 			= 'aulv_id';
	private $_model_crud 		= 'adminuserlevel_model';
	private $_data 				= array();

	function __construct(){
		parent::__construct();

		$this->config->load('assets');
		$path_web = $this->config->item('backstage');
		$this->_data['assets'] 	= site_url($path_web['assets']);
		
	}

	private function get_show_column() {
		$column_list = array(
			array(
				'title_header_column' 	=> 'No.',
				'field_name' 			=> $this->_table_field_pref . 'id',
				'show_no_static' 		=> true,
				'no_order'				=> 0,
			),
			array(
				'title_header_column' 	=> 'Level Name',
				'field_name' 			=> $this->_table_field_pref . 'name',
				'no_order'				=> 1,
			),
			array(
				'title_header_column' 	=> 'Action',
				'field_name' 			=> $this->_table_field_pref . 'id',
				'result_format'			=> function( $d, $row ) {
			            return '<a href="http://localhost/antrian_fresh/simple_datatable/edit/'.$d.'" class="btn btn-xs btn-success">EDIT <i class="glyph-icon icon-pencil-square-o"></i></a> <a href="http://localhost/antrian_fresh/simple_datatable/delete/'.$d.'" class="btn btn-xs btn-danger">DELETE <i class="glyph-icon icon-close"></i></a>';
			        },
			    'no_order'				=> 2,
			),
		);

		return $column_list;
	}

	private function get_input_field_new($data_value = array()) {
		$data_input = array(
			array(
				'db_field' 		=> $this->_table_field_pref . 'id',
				'db_pk' 		=> true,
				'db_process'	=> false,
				'data_edit'		=> array(
					'db_process'		=> false,
				),
			),
			array(
				'label' 		=> 'Username',
				'db_field' 		=> $this->_table_field_pref . 'name',
				'db_process'	=> true,
				'input_type'	=> 'text',
				'input_attr'	=> 'type="text" data-parsley-minlength="4" class="form-control" placeholder="Name level..."',
				'required'		=> 'required',
				'data_source'	=> '',
				'data_edit'		=> array(
					'db_process'	=> true,
					'required'		=> 'required',
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

	public function index()
	{
		$this->_data['column_list'] = $this->get_show_column();
		$this->_data['ajax_lists'] = 'http://localhost/antrian_fresh/simple_datatable/lists_ajax';
		$this->load->view('simple_datatable_lists', $this->_data);
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

	function add() {
		$this->_data['ajax_action_add'] 	= site_url($this->_module_controller . 'do_add_ajax');
		$this->_data['input_list'] 			= $this->get_input_field_new();
		$this->load->view('simple_datatable_add', $this->_data);
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

	function add_process() {
		if($this->do_add()) {
			redirect('simple_datatable');
			exit();
		} else {
			echo "Error insert!";
		}
	}

	function edit($id) {
		$data_id = $id;
		$data = $this->crudmodel->where(array($this->_table_pk => $data_id ))->get_login();
		$this->_data['data_row'] = $data;

		$this->_data['input_list'] 			= $this->get_input_field_new($data);

		$this->load->view('simple_datatable_edit', $this->_data);
	}

	function edit_process() {
		if($this->do_edit()) {
			redirect('simple_datatable');
			exit();
		} else {
			echo "Error update!";
		}
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

	function delete($id) {
		if($this->do_delete($id)) {
			redirect('simple_datatable');
			exit();
		} else {
			echo "Error delete!";
		}
	}

	function do_delete($id) {
		$data_id = $id;
		if(!empty($data_id)) {
			$delete = $this->crudmodel->delete(array($this->_table_pk => $data_id));
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
}