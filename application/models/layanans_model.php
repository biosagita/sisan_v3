<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Layanans_model extends CI_Model {
	
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
		return $this->db->get('layanan')->row_array();
	}

	function get_row(){
		return $this->db->get('layanan')->row_array();
	}
	
	function get_all(){
		return $this->db->get('layanan')->result_array();
	}
	
	function posts($data){
		return $this->db->insert('layanan', $data);
	}
	
	function puts($data){
		return $this->db->update('layanan', $data);
	}
	
	function delete($data){
		return $this->db->delete('layanan', $data);
	}

	function get_option() {
		$res = $this->get_all();
		$data = array();
		foreach ($res as $key => $value) {
			$data[] = array(
				'name' 	=> $value['lay_nama_layanan'],
				'value' => $value['lay_id_layanan'],
			); 
		}
		return $data;
	}

	function get_layanancounter($id_loket = '') {
		//$GroupLayanan= $this->session->userdata('admin_usergrouplayanan');
		//if(empty($GroupLayanan)) return;

		$this->db->select('prilay_id_group_layanan');
		$this->db->from('lokets');
		$this->db->join('prioritas_layanan', 'lokets_grolok_id = prilay_id_group_loket', 'left');
		$this->db->where('lokets_id = "' . $id_loket . '"');
		$res = $this->db->get()->row_array();

		if(empty($res['prilay_id_group_layanan'])) return;
		$vItems = array();
		$q = 'SELECT lay_id_layanan, lay_nama_layanan, lay_id_group_layanan FROM anf_layanan WHERE lay_id_group_layanan NOT IN ('.$res['prilay_id_group_layanan'].')';
		$query = $this->db->query($q);
		foreach ($query->result() as $vRow)
		{
		   $vItems[$vRow->lay_id_group_layanan] = (array) $vRow;
		}
		return $vItems;
	}
	
}

?>