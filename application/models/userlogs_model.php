<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userlogs_model extends CI_Model {
	
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
		return $this->db->get('user_log')->row_array();
	}
	
	function get_all(){
		return $this->db->get('user_log')->result_array();
	}
	
	function posts($data){
		return $this->db->insert('user_log', $data);
	}
	
	function puts($data){
		return $this->db->update('user_log', $data);
	}
	
	function delete($data){
		return $this->db->delete('user_log', $data);
	}

	function log_logout($user_id) {
		$q = 'SELECT usrlog_log_id FROM anf_user_log WHERE usrlog_user_id = "'.$user_id.'" AND (usrlog_logout_date = "0000-00-00 00:00:00" OR usrlog_logout_date IS NULL) ORDER BY usrlog_login_date DESC LIMIT 1';

		$query = $this->db->query($q);
		$usrlog_log_id = '';
		foreach ($query->result() as $vRow)
		{
		   $usrlog_log_id = $vRow->usrlog_log_id;
		}

		$vData = array(		           
			'usrlog_logout_date'	=> date('Y-m-d H:i:s')
		);
		$this->db->where('usrlog_log_id', $usrlog_log_id);
		$vResult = $this->db->update('anf_user_log',$vData);
	}
	
}

?>