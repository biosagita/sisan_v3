<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminuser_model extends CI_Model {
	
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
		return $this->db->get('adminusers')->row_array();
	}

	function get_login_userlevel(){
		$this->db->select("admusr_image, admusr_id, admusr_aulv_id, admusr_username, aulv_name, admusr_usrgro_id, usrgrolay_grolay_id,
			  $query_opt
			  ");
		$this->db->from('adminusers');
		$this->db->join('adminuserlevel', 'admusr_aulv_id = aulv_id', 'left');
		$this->db->join('user_group_layanan', 'admusr_usrgro_id = usrgrolay_usrgro_id', 'left');

		return $this->db->get()->row_array();
	}
	
	function get_all(){
		return $this->db->get('adminusers')->result_array();
	}
	
	function posts($data){
		return $this->db->insert('adminusers', $data);
	}
	
	function puts($data){
		return $this->db->update('adminusers', $data);
	}
	
	function delete($data){
		return $this->db->delete('adminusers', $data);
	}

	function get_option() {
		$res = $this->get_all();
		$data = array();
		foreach ($res as $key => $value) {
			$data[] = array(
				'name' 	=> $value['admusr_username'],
				'value' => $value['admusr_id'],
			); 
		}
		return $data;
	}

	function check_completelogin($query_opt = '') {
		$this->db->select("admusr_id, admusr_aulv_id, usrgrolay_grolay_id, prilay_id_group_loket, lokets_id, admusr_username, aulv_name,
			  $query_opt
			  ");
		$this->db->from('adminusers');
		$this->db->join('adminuserlevel', 'admusr_aulv_id = aulv_id', 'left');
		$this->db->join('user_group_layanan', 'admusr_usrgro_id = usrgrolay_usrgro_id', 'left');
		$this->db->join('prioritas_layanan', 'usrgrolay_grolay_id = prilay_id_group_layanan', 'left');
		$this->db->join('lokets', 'prilay_id_group_loket = lokets_grolok_id', 'left');

		return $this->db->get()->row_array();
	}
	
}

?>