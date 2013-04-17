<?php
require_once("model/model_comment.php");

if (empty($_POST["comment_content"]))
	{
		$error_array["comment"] = "Veuillez remplir le contenu du commentaire !";
	}
else
	{
		secure_session($_SESSION["user"]["user_id"],"Vous ne pouvez pas mettre &agrave; jour ce commentaire car vous n'&ecirc;tes pas connect&eacute; !");
		if ($_SESSION["user"]["id_role"]==3) {

			update_comment($_POST["comment_content"],$_POST["comm_id"]);
			header('Location: index.php');
			die();

		}
		secure_id($_POST["comm_id"],$comm_by_user,"Vous ne pouvez pas mettre &agrave; jour un commentaire qui ne vous appartient pas !");
		update_comment($_POST["comment_content"],$_POST["comm_id"]);
	}

?>