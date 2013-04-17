<?php 
require_once("model/model_post.php");
secure_session($_SESSION["user"]["user_id"],"Vous ne pouvez pas ajouter de billets car vous n'&ecirc;tes pas connect&eacute; !");
if ($_SESSION["user"]["id_role"]==1) {

	$_SESSION["secure"]="Vous n'avez pas les droit pour accéder à cette ressource !";
	header('location: index.php');
	die();
}

if (empty($_POST["title"]) || (empty($_POST["content"])))
	$error_array["post"] = "Veuillez remplir le champ \"titre\" et le contenu du billet";

if (empty($error_array["post"]))
	{
		add_post($_POST["title"],$_POST["content"],$_SESSION["user"]["user_id"]);
		header("Location: index.php?action=getpostuser");
		die();
	}

?>