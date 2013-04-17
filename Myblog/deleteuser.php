<?php 
require_once('model/model_user.php');
secure_session($_SESSION['user']['user_id'],'Vous ne pouvez pas accéder à cette ressource');

if ($_SESSION['user']['id_role'] != 3) {

	$_SESSION["secure"]="Vous n'avez pas les droit pour accéder à cette ressource !";
	header('location: index.php');
	die();
}
else {

	secure_id($_GET['user_id'],$users_id,"L'utilisateur que vous tentez de supprimer n'existe pas !");
	deleteuser($_GET['user_id']);
	header('Location: ' . $_SERVER['HTTP_REFERER']); 
	exit;
}

?>