<?php
session_start();
function instance ($class) {
	$paths = array("classes" => "./Classes/".ucfirst($class).".php",
				   "model" => "./model/".strtolower($class).".php",
				   "interfaces" => "./Interfaces/".$class.".php",
				   "controllers" => "./Controllers/".$class.".php"

	);

	foreach ($paths as $key => $path) {
		if (is_readable($path) && is_file($path)) {
    		require_once($path);
		}
   	}
}
spl_autoload_register('instance');

require_once 'dbtools.php';
require_once 'config.php';

// Valeur de l'action par défaut
$action = $config['default']['action'];

// Router
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// Vérification de l'existence de l'action
if (!array_key_exists($action, $config['routes'])) {
    die ("L'action ".$action." n'existe pas. <br /> <a href='index.php'>retour &agrave; l'accueil</a>");
}

// Instanciation du controller et appel de l'action
$method = $action;
$controller = ucfirst($config['routes'][$action]).'Controller';
${$config['routes'][$action]} = NULL;

if (!is_object(${$config['routes'][$action]})) {
	${$config['routes'][$action]} = new $controller();
}

if (method_exists(${$config['routes'][$action]}, $method)) {
	$var = ${$config['routes'][$action]}->$method();
}

// set template
$path = './templates/'.$template.'.php';

include_once('./view/main.php');

// $u = new User(array('pseudo' => 'portier'));
// $u->save();
// $champions = new Warrior();
// $champions->save();
// $u->add_champion($champions);
// $u->save_collections('champions');
// var_dump($u);



