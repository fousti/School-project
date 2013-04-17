<?php
require_once('model/model_post.php');

if (empty($_POST["content"]) || empty($_POST["title"]))
	{
		$error_array["post"] = "Veuillez remplir le champ \"titre\" et le contenu du billet";
	}
else
	{
		secure_session($_SESSION["user"]["user_id"],"Vous ne pouvez pas mettre &agrave; jour ce billet car vous n'&ecirc;tes pas connect&eacute; !");
		if ($_SESSION["user"]["id_role"]==1) {

			$_SESSION["secure"]="Vous n'avez pas les droit pour accéder à cette ressource !";
			header('location: index.php');
			die();
		}
		elseif ($_SESSION["user"]["id_role"]==3) {

			update_post($_POST["title"],$_POST["content"],$_POST["post_id"]);
			header('location: index.php');
			die();

		}
		else {

			secure_id($_POST["post_id"],$posts_by_user,"Vous ne pouvez pas mettre à jour un billet qui ne vous appartient pas !");
			update_post($_POST["title"],$_POST["content"],$_POST["post_id"]);
		}

		
	}

?>