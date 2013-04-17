<?php
require_once('model/model_comment.php');

secure_session($_SESSION["user"]["user_id"],"Vous ne pouvez pas ajouter de commentaire car vous n'&ecirc;tes pas connect&eacute; !");
secure_id($_GET["post_id"],$posts_ids,"Vous essayez d'ajouter un commentaire sur un billet qui n'existe pas !");

if (empty($_POST["comment_content"]))
	$error_array["comment"] = "Veuillez remplir le contenu du commentaire !";


if (empty($error_array["comment"]))
	{
		add_comment($_POST["comment_content"],$_GET["post_id"],$_SESSION["user"]["user_id"]);
		header("Location: index.php?view=comment&action=getcomment&post_id=".$_GET["post_id"]);
		die();
	}


 ?>