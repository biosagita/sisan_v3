<?php

function generateDataTable($table, $primaryKey, $columns, $whereResult=null, $whereAll=null) {
	$CI =& get_instance();
	$CI->load->library('ssp');
	$CI->load->database();

	// SQL server connection information
	$sql_details = array(
	    'user' => $CI->db->username,
	    'pass' => $CI->db->password,
	    'db'   => $CI->db->database,
	    'host' => $CI->db->hostname
	);
	 
	echo json_encode(
	    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $whereResult, $whereAll)
	);
}