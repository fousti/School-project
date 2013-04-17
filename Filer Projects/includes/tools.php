<?php 
function clean_path($path,$root) {

	$cpath = realpath($path) ;
	$rpath = realpath($root) ;
	if (strpos($cpath,$rpath) === 0) {
		return($path);
	}
	else {
		return($root);
	}
}

function db_connect() {

	global $config ;
	$link = mysqli_connect($config['db']['server'],$config['db']['user'],$config['db']['pass'],$config['db']['db_name']);

if ($link===FALSE)
	die(mysqli_connect_error());
	
	return($link);
}

function url_enc($path) {

		if (($pos = stripos($path, '/',stripos($path, '/')+1)) === FALSE) {

			return('');
		}
		return(substr($path, $pos));

}



?>