<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Waktulayanans_model extends CI_Model {
	
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
		return $this->db->get('waktu_layanan')->row_array();
	}
	
	function get_all(){
		return $this->db->get('waktu_layanan')->result_array();
	}
	
	function posts($data){
		return $this->db->insert('waktu_layanan', $data);
	}
	
	function puts($data){
		return $this->db->update('waktu_layanan', $data);
	}
	
	function delete($data){
		return $this->db->delete('waktu_layanan', $data);
	}

	function get_option() {
		$res = $this->get_all();
		$data = array();
		foreach ($res as $key => $value) {
			$data[] = array(
				'name' 	=> ($value['waklay_waktu_awal_1'] . '-' . $value['waklay_waktu_akhir_1']),
				'value' => $value['waklay_id_waktu_layanan'],
			); 
		}
		return $data;
	}
	
}

?>