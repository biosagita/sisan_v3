<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedules_model extends CI_Model {
	
	function where($where = '') {
		if($where != '') $this->db->where($where);
		return $this;
	}
	
	function set_limit($limit, $start = 0) {
    	$this->db->limit($limit, $start);
        return $this;
    }
	
	function order_by($field, $direction = 'asc') {
		$this->db->order_by($field, $direction);
		return $this;
	}
	
	function like($field, $keyword, $pattern = 'both') {
		$this->db->like($field, $keyword, $pattern);
		return $this;
	}
	
	function or_like($field, $keyword = '', $pattern = 'both'){
		if($keyword != '') $this->db->or_like($field, $keyword, $pattern);
		else  $this->db->or_like($field);
		return $this;
	}
	
	function group_by($group_by = ''){
		$this->db->group_by($group_by);
		return $this;
	}
	
	/* ---------------------------------------- All About Admin ------------------------- */
	
	function get_login(){
		return $this->db->get('schedule')->row_array();
	}
	
	function get_all(){
		return $this->db->get('schedule')->result_array();
	}
	
	function posts($data){
		return $this->db->insert('schedule', $data);
	}
	
	function puts($data){
		return $this->db->update('schedule', $data);
	}
	
	function delete($data){
		return $this->db->delete('schedule', $data);
	}

    function get_option_hari() {
        $res = [
            [
                'id_hari' => 'senin',
                'nama_hari' => 'Senin',
            ],
            [
                'id_hari' => 'selasa',
                'nama_hari' => 'Selasa',
            ],
            [
                'id_hari' => 'rabu',
                'nama_hari' => 'Rabu',
            ],
            [
                'id_hari' => 'kamis',
                'nama_hari' => 'Kamis',
            ],
            [
                'id_hari' => 'jumat',
                'nama_hari' => 'Jumat',
            ],
            [
                'id_hari' => 'sabtu',
                'nama_hari' => 'Sabtu',
            ],
            [
                'id_hari' => 'minggu',
                'nama_hari' => 'Minggu',
            ],
        ];
        $data = array();
        foreach ($res as $key => $value) {
            $data[] = array(
                'name' 	=> $value['nama_hari'],
                'value' => $value['id_hari'],
            );
        }
        return $data;
    }
	
}

?>