<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prioritaslayanans_model extends CI_Model {
	
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
		return $this->db->get('prioritas_layanan')->row_array();
	}
	
	function get_all(){
		return $this->db->get('prioritas_layanan')->result_array();
	}
	
	function posts($data){
		return $this->db->insert('prioritas_layanan', $data);
	}
	
	function puts($data){
		return $this->db->update('prioritas_layanan', $data);
	}
	
	function delete($data){
		return $this->db->delete('prioritas_layanan', $data);
	}

	function get_loket_group_layanan() {
		$q = 'SELECT lokets_id, lokets_name, lokets_grolok_id, prilay_id_group_layanan FROM 
		anf_prioritas_layanan
		LEFT JOIN anf_lokets ON (prilay_id_group_loket = lokets_grolok_id)
		ORDER BY lokets_grolok_id';

		$query = $this->db->query($q);
		foreach ($query->result() as $vRow)
		{
		   $vItems[$vRow->prilay_id_group_layanan][$vRow->lokets_grolok_id][$vRow->lokets_id] = $vRow->lokets_name;
		}
		return $vItems;
	}
	
}

?>