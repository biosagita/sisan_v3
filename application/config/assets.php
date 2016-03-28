<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
/**
 * This is assets path configurations
 */

//----list of images----
$_list_image = array(
	"individu",
	"group",
	"joinnow",
);

$_size_image = array(
	'' 			=> '',
	'_vsmall' 	=> '/75x75',
	'_small' 	=> '/110x110',
	'_medium' 	=> '/220x220',
	'_large' 	=> '/330x330',
);

/* ------------------- Frontend ----------------- */

// Frontend js files
$config["frontend"]["assets"] = "assets/frontend/";

// Frontend $value image files
foreach ($_list_image as $key => $value) {
	foreach ($_size_image as $kSize => $vSize) {
		$tmp = $value."images".$kSize;
		$config["frontend"][$tmp]  = "assets/frontend/images/".$value."-pics".$vSize;
	}
}

/* ----------------- End of Frontend ------------------*/

/* ------------------- Backstage ----------------- */

// Backstage js files
$config["backstage"]["assets"] = "assets/backstage/";

// Backstage MP Products image files
foreach ($_list_image as $key => $value) {
	foreach ($_size_image as $kSize => $vSize) {
		$tmp = $value."images".$kSize;
		$config["backstage"][$tmp]  = "assets/frontend/images/".$value."-pics".$vSize;
	}
}

/* ----------------- End of Backstage ------------------*/

$config["counter"]["assets"] = "assets/counter/";

?>