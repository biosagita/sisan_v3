<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loketlogs_model extends CI_Model {
	
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
		return $this->db->get('loket_log')->row_array();
	}
	
	function get_all(){
		return $this->db->get('loket_log')->result_array();
	}
	
	function posts($data){
		return $this->db->insert('loket_log', $data);
	}
	
	function puts($data){
		return $this->db->update('loket_log', $data);
	}
	
	function delete($data){
		return $this->db->delete('loket_log', $data);
	}

	function log_logout($user_id) {
		$q = 'SELECT loklog_log_id FROM anf_loket_log WHERE loklog_user_id = "'.$user_id.'" AND loklog_logout_date = "0000-00-00 00:00:00" ORDER BY loklog_login_date DESC LIMIT 1';

		$query = $this->db->query($q);
		$loklog_log_id = '';
		foreach ($query->result() as $vRow)
		{
		   $loklog_log_id = $vRow->loklog_log_id;
		}

		$vData = array(		           
			'loklog_logout_date'	=> date('Y-m-d H:i:s')
		);
		$this->db->where('loklog_log_id', $loklog_log_id);
		$vResult = $this->db->update('anf_loket_log',$vData);
	}
	
}

?>