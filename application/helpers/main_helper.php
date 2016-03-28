<?php
if (!function_exists('get_show_date'))
{
	function get_show_date($now = '') {
		//$now = date('Y-m-d h:i:s');
		if(empty($now)) return false;
		list($year, $month, $day, $hour, $min, $sec) = preg_split('/[: -]/', $now);
		$arr = array(
			'year' 	=> $year,
			'month' => $month,
			'day' 	=> $day,
			'hour' 	=> $hour,
			'min' 	=> $min,
			'sec' 	=> $sec,
		);
	    return $arr;
	}
}

if (!function_exists('get_current_url_other'))
{
	function get_current_url_other() {

		$protocol = 'http';
		if ($_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')) {
			$protocol .= 's';
			$protocol_port = $_SERVER['SERVER_PORT'];
		} else {
			$protocol_port = 80;
		}

		$host = $_SERVER['HTTP_HOST'];
		$port = $_SERVER['SERVER_PORT'];
		$request = $_SERVER['PHP_SELF'];
		$query = isset($_SERVER['argv']) ? substr($_SERVER['argv'][0], strpos($_SERVER['argv'][0], ';') + 1) : '';

		$toret = $protocol . '://' . $host . ($port == $protocol_port ? '' : ':' . $port) . $request . (empty($query) ? '' : '?' . $query);

		return $toret;
	}
}

if (!function_exists('get_current_url_own'))
{
	function get_current_url_own() {

	  	$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
		if ($_SERVER["SERVER_PORT"] != "80")
		{
		    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} 
		else 
		{
		    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
}

if (!function_exists('get_client_ip'))
{
	function get_client_ip() {
	    $ipaddress = '';
	    if ($_SERVER['HTTP_CLIENT_IP'])
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if($_SERVER['HTTP_X_FORWARDED'])
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if($_SERVER['HTTP_FORWARDED_FOR'])
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if($_SERVER['HTTP_FORWARDED'])
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if($_SERVER['REMOTE_ADDR'])
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}
}