<?php 
require_once('model/model_comment.php');

//supprime un commentaire d'un user
if (isset($_SESSION["user"])&&$_SESSION["user"]==3) {

	delete_post($_GET["post_id"]);
	header('Location: index.php');
	die();

}

secure_id($_GET["comm_id"],$comm_by_user,"Vous tentez de supprimer un commentaire qui ne vous appartient pas !");

delete_comment($_GET["comm_id"]);
header("Location: index.php?view=comment&action=getcomment&post_id=".$_GET["post_id"]);
die();




?>