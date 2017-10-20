<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class schedules extends MY_Admin {
	private $_template 			= 'template_admin/main';
	private $_module_controller = 'backend_schedules/schedules/';
	private $_table_name 		= 'schedule';
	private $_table_field_pref 	= 'schd_';
	private $_table_pk 			= 'schd_id';
	private $_model_crud 		= 'schedules_model';

	private $_page_title 		= 'Antrian : Admin Schedule';
	private $_page_content_info	= array(
		'title' => 'Data Schedule',
		'desc' 	=> 'List Schedule',
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
                'field_name' 			=> 'lay_nama_layanan',
                'just_info' 			=> true,
            ),
        );

        return $additional_field;
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
				'title_header_column' 	=> 'Layanan',
				'field_name' 			=> 'lay_nama_layanan',
				'no_order'				=> 1,
			),
            array(
                'title_header_column' 	=> 'Hari',
                'field_name' 			=> $this->_table_field_pref . 'hari',
                'no_order'				=> 2,
            ),
            array(
                'title_header_column' 	=> 'Schedule',
                'field_name' 			=> $this->_table_field_pref . 'schedule',
                'result_format'			=> function( $d, $row ) {
                    $res = '';
                    $tmp = json_decode($d);
                    if(!empty($tmp)) {
                        $arr = [];
                        foreach ($tmp as $key => $value) {
                            $tmpArr = [
                                ('<b>[ Schedule ' . ($key + 1) . ' ]</b>'),
                                ('Jam Awal Tiket: ' . $value->jam_awal_tiket),
                                ('Jam Akhir Tiket: ' . $value->jam_akhir_tiket),
                                ('Jam Awal Layanan: ' . $value->jam_awal_layanan),
                                ('Jam Akhir Layanan: ' . $value->jam_akhir_layanan),
                                ('Stok: ' . (!empty($value->stok) ? $value->stok : 0)),
                                ('Continue: ' . (!empty($value->flag_continue) ? $value->flag_continue : 0)),
                                ('Active: ' . (!empty($value->flag_active) ? $value->flag_active : 0)),
                            ];
                            $arr[] = '<li>' . join('</li><li>', $tmpArr) . '</li>';
                        }
                        if(!empty($arr)) $res = '<ul style="margin-top: 0;">' . join('</ul><ul>', $arr) . '</ul>';
                    }
                    return $res;
                },
                'no_order'				=> 3,
            ),
			array(
				'title_header_column' 	=> 'Action',
				'field_name' 			=> $this->_table_field_pref . 'id',
				'result_format'			=> function( $d, $row ) {
			            return '<a onclick="doFormEdit('.$d.');return false;" href="#" class="btn btn-xs btn-success">EDIT <i class="glyph-icon icon-pencil-square-o"></i></a> <a onclick="showModalBoxDelete('.$d.');return false;" href="#" class="btn btn-xs btn-danger">DELETE <i class="glyph-icon icon-close"></i></a>';
			        },
			    'no_order'				=> 4,
			),
		);

		return $column_list;
	}

	private function get_input_field_new($data_value = array()) {
        $this->load->model('layanans_model','layanans');
        $source_layanan = $this->layanans->get_option();

        $source_hari = $this->crudmodel->get_option_hari();

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
                'label' 		=> 'Layanan',
                'db_field' 		=> $this->_table_field_pref . 'id_layanan',
                'db_process'	=> true,
                'input_type'	=> 'select',
                'input_attr'	=> 'class="form-control"',
                'required'		=> 'required',
                'data_source'	=> $source_layanan,
                'data_edit'		=> array(
                    'required'			=> 'required',
                    'db_process'		=> true,
                ),
            ),
            array(
                'label' 		=> 'Hari',
                'db_field' 		=> $this->_table_field_pref . 'hari',
                'db_process'	=> true,
                'input_type'	=> 'select',
                'input_attr'	=> 'class="form-control"',
                'required'		=> 'required',
                'data_source'	=> $source_hari,
                'data_edit'		=> array(
                    'required'			=> 'required',
                    'db_process'		=> true,
                ),
            ),
            array(
                'label' 		=> 'Schedule',
                'isJson' 		=> true,
                'db_field' 		=> $this->_table_field_pref . 'schedule',
                'db_process'	=> true,
                'input_type'	=> 'text',
                'input_attr'	=> 'type="text" data-parsley-minlength="1" class="form-control"',
                'data_source'	=> '',
                'data_edit'		=> array(
                    'db_process'	=> true,
                    'isJson'		=> true,
                ),
            ),
		);

		if(!empty($data_value)) {
			foreach ($data_input as $key => $value) {
				if(!empty($data_input[$key]['data_edit']['input_empty']) AND $data_input[$key]['data_edit']['input_empty']) {
					$data_input[$key]['data_edit']['input_value'] = '';
				} elseif(!empty($data_input[$key]['data_edit']['isJson'])) {
                    $data_input[$key]['data_edit']['input_value'] = !empty($data_value[$data_input[$key]['db_field']]) ? json_decode($data_value[$data_input[$key]['db_field']]) : '';
                }else {
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
        $table 		.= ' LEFT JOIN ' . $this->db->dbprefix . 'layanan ON (schd_id_layanan = lay_id_layanan) ';
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
                );
                $cnt++;
            }
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

        $hdInput = $this->input->post('hdInput');
        $dataJson = '';
        if(!empty($hdInput)) {
            $jam_awal_tiket = $this->input->post('jam_awal_tiket');
            $jam_akhir_tiket = $this->input->post('jam_akhir_tiket');
            $jam_awal_layanan = $this->input->post('jam_awal_layanan');
            $jam_akhir_layanan = $this->input->post('jam_akhir_layanan');
            $stok = $this->input->post('stok');
            $flag_continue = $this->input->post('flag_continue');
            $flag_active = $this->input->post('flag_active');
            if(!empty($hdInput)) {
                $tmp = [];
                foreach ($hdInput as $key => $value) {
                    if(empty($jam_awal_tiket[$key])) continue;
                    $tmp[] = [
                        'jam_awal_tiket' => (!empty($jam_awal_tiket[$key]) ? $jam_awal_tiket[$key] : ''),
                        'jam_akhir_tiket' => (!empty($jam_akhir_tiket[$key]) ? $jam_akhir_tiket[$key] : ''),
                        'jam_awal_layanan' => (!empty($jam_awal_layanan[$key]) ? $jam_awal_layanan[$key] : ''),
                        'jam_akhir_layanan' => (!empty($jam_akhir_layanan[$key]) ? $jam_akhir_layanan[$key] : ''),
                        'stok' => (!empty($stok[$key]) ? $stok[$key] : ''),
                        'flag_continue' => (!empty($flag_continue[$key]) ? $flag_continue[$key] : ''),
                        'flag_active' => (!empty($flag_active[$key]) ? $flag_active[$key] : ''),
                    ];
                }
                $dataJson = json_encode($tmp);
            }
        }

		foreach ($input_list as $key => $value) {
            if(!empty($value['isJson'])) continue;

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
                if(!empty($dataJson)) {
                    $admin_data['schd_schedule'] = $dataJson;
                }

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

		$hdInput = $this->input->post('hdInput');
		$dataJson = '';
		if(!empty($hdInput)) {
            $jam_awal_tiket = $this->input->post('jam_awal_tiket');
            $jam_akhir_tiket = $this->input->post('jam_akhir_tiket');
            $jam_awal_layanan = $this->input->post('jam_awal_layanan');
            $jam_akhir_layanan = $this->input->post('jam_akhir_layanan');
            $stok = $this->input->post('stok');
            $flag_continue = $this->input->post('flag_continue');
            $flag_active = $this->input->post('flag_active');
            if(!empty($hdInput)) {
                $tmp = [];
                foreach ($hdInput as $key => $value) {
                    if(empty($jam_awal_tiket[$key])) continue;
                    $tmp[] = [
                        'jam_awal_tiket' => (!empty($jam_awal_tiket[$key]) ? $jam_awal_tiket[$key] : ''),
                        'jam_akhir_tiket' => (!empty($jam_akhir_tiket[$key]) ? $jam_akhir_tiket[$key] : ''),
                        'jam_awal_layanan' => (!empty($jam_awal_layanan[$key]) ? $jam_awal_layanan[$key] : ''),
                        'jam_akhir_layanan' => (!empty($jam_akhir_layanan[$key]) ? $jam_akhir_layanan[$key] : ''),
                        'stok' => (!empty($stok[$key]) ? $stok[$key] : ''),
                        'flag_continue' => (!empty($flag_continue[$key]) ? $flag_continue[$key] : ''),
                        'flag_active' => (!empty($flag_active[$key]) ? $flag_active[$key] : ''),
                    ];
                }
                $dataJson = json_encode($tmp);
            }
        }
        /*echo $dataJson;
        exit();*/

		foreach ($input_list as $key => $value) {
            if(!empty($value['data_edit']['isJson'])) continue;

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

			if(!empty($dataJson)) {
                $admin_data['schd_schedule'] = $dataJson;
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