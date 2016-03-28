<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lokets_model extends CI_Model {
	
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
		return $this->db->get('lokets')->row_array();
	}

	function get_row(){
		return $this->db->get('lokets')->row_array();
	}

	function get_loketname(){
		$tmp = $this->db->get('lokets')->row_array();
		$loketname = !empty($tmp['lokets_name']) ? $tmp['lokets_name'] : '-';
		return $loketname;
	}
	
	function get_all(){
		return $this->db->get('lokets')->result_array();
	}
	
	function posts($data){
		return $this->db->insert('lokets', $data);
	}
	
	function puts($data){
		return $this->db->update('lokets', $data);
	}
	
	function delete($data){
		return $this->db->delete('lokets', $data);
	}

	function get_option() {
		$res = $this->get_all();
		$data = array();
		foreach ($res as $key => $value) {
			$data[] = array(
				'name' 	=> $value['lokets_name'],
				'value' => $value['lokets_id'],
			); 
		}
		return $data;
	}

	function get_all_loket_layanan($query_opt = '') {
		$this->db->select("*,
			  $query_opt
			  ");
		$this->db->from('lokets');
		$this->db->join('prioritas_layanan', 'lokets_grolok_id = prilay_id_group_loket', 'left');
		$this->db->join('group_layanan', 'prilay_id_group_layanan = grolay_id_group_layanan', 'left');
		$this->db->join('layanan', 'grolay_id_group_layanan = lay_id_group_layanan', 'left');
		$this->db->order_by('lokets_id');

		return $this->db->get()->result_array();
	}

	function get_simple_loket() {
		$res = $this->get_all_loket_layanan();
		$data = array();
		foreach ($res as $key => $value) {
			$data[$value['lokets_id']]['loket_name'] 		= $value['lokets_name'];
			$data[$value['lokets_id']]['loket_url_action'] 	= site_url('counter_loketdestination/loketdestination/viewing/' . $value['lokets_id']);
			if(!empty($value['lay_id_layanan'])) $data[$value['lokets_id']]['loket_layanan'][$value['lay_id_layanan']] = $value['lay_nama_layanan'];
		}
		return $data;
	}

	function get_simple_changeloket() {
		$res = $this->get_all_loket_layanan();
		$data = array();
		foreach ($res as $key => $value) {
			$data[$value['lokets_id']]['loket_name'] 		= $value['lokets_name'];
			$data[$value['lokets_id']]['loket_url_action'] 	= site_url('counter_changeloket/changeloket/viewing/' . $value['lokets_id']);
			if(!empty($value['lay_id_layanan'])) $data[$value['lokets_id']]['loket_layanan'][$value['lay_id_layanan']] = $value['lay_nama_layanan'];
		}
		return $data;
	}
	
}

?>