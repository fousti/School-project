<?php 
require_once('model/model_comment.php');
if (isset($_SESSION["user"]["id_role"])&&$_SESSION["user"]["id_role"]==3) {

		$comment = getcommentbyId($_GET["comm_id"]);
}
else {
	secure_id($_GET["comm_id"], $comm_by_user, "Vous ne pouvez pas acc&eacute;der &agrave; la ressource/action que vous demandez, vous avez &eacute;t&eacute; redirig&eacute; sur la page d'accueil ! 4");
	$comment = getcommentbyId($_GET["comm_id"]);

}

?>