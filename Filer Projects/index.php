<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('includes/config.php');
include('includes/tools.php');
$link = db_connect();

if (isset($_SESSION['user']['id_user'])) {

	$template = 'filer';
	$config['root'] = $config['root'].'/'.$_SESSION['user']['mail'];
	if (empty($_GET['action'])) {
		$_GET['action'] = 'readdir';
	}
	if (!empty($_GET['view'])) {
		$template = $_GET['view'];
	}
}

else {
								
	$template = 'signup' ;	
	$action = '';
}


if (isset($_GET['action'])&&array_key_exists($_GET['action'], $config['routes'])) {

	$action = $_GET['action'] ;
	include('actiongroups/'.$config['routes'][$action].'controller.php') ;
}

include('views/main.php');

?>