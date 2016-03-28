<?php
/* Image Quality Configuration */
$config['images']['quality']['very_low'] 	= 50;
$config['images']['quality']['low'] 		= 60;
$config['images']['quality']['medium'] 		= 70;
$config['images']['quality']['high'] 		= 80;
$config['images']['quality']['very_high'] 	= 90;

/* Image Quality DPI */ 
$config['images']['dpi']['high'] 	= 300;
$config['images']['dpi']['medium'] 	= 200;
$config['images']['dpi']['low'] 	= 100;

/* Image Resolution */
$config['images']['resolution']['highest'] 		= 2200;
$config['images']['resolution']['very_high'] 	= 1024;
$config['images']['resolution']['high'] 		= 960;
$config['images']['resolution']['medium'] 		= 720;
$config['images']['resolution']['low'] 			= 600;
$config['images']['resolution']['very_low'] 	= 300;

//----list of images----
$_list_image = array(
	'individu',
	'group',
	'joinnow',
);

$_size_image = array(
	array(
		'height' 	=> 75,
		'width' 	=> 75,
		'type' 		=> 'vsmall',
	),
	array(
		'height' 	=> 110,
		'width' 	=> 110,
		'type' 		=> 'small',
	),
	array(
		'height' 	=> 220,
		'width' 	=> 220,
		'type' 		=> 'medium',
	),
	array(
		'height' 	=> 330,
		'width' 	=> 330,
		'type' 		=> 'large',
	),
);

foreach ($_list_image as $key => $value) {
	$config[$value]['images']['tmp']['name'] = $value."_%s_%s";

	foreach ($_size_image as $kSize => $vSize) {
		$type = $vSize['type'];
		$config[$value]['images'][$type]['name'] = $config[$value]['images']['tmp']['name']."_".$vSize['width']."x".$vSize['height'];
		$config[$value]['images'][$type]['height'] = $vSize['height'];
		$config[$value]['images'][$type]['width'] = $vSize['width'];
		$config[$value]['images'][$type]['directory'] = "./assets/frontend/images/$value-pics/".$vSize['width']."x".$vSize['height'];
	}

	$config[$value]['images']['orientation'] = "square";
}

?>