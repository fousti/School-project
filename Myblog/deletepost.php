<?php
require_once("model/model_post.php");

//Supprime le post d'un user
if (isset($_SESSION["user"])&&$_SESSION["user"]["id_role"]==3) {

	delete_post($_GET["post_id"]);
	header('Location: index.php');
	die();

}


secure_id($_GET["post_id"],$posts_by_user,"Vous ne pouvez pas supprimer un billet qui ne vous appartient pas !");



delete_post($_GET["post_id"]);
header('Location: index.php');
die();	

?>