<?php 
require_once('model/model_post.php');
secure_session($_SESSION["user"]["user_id"],"Vous ne pouvez pas acc&eacute;der &agrave; cette ressource car vous n'&ecirc;tes pas connect&eacute;, ou connect&eacute; sous un autre compte !");
$post_per_page = 5;
if (isset($_GET["page"]))
	{
		$page = $_GET["page"];
	}
else
	{
		$page = 1;
	}

$first_message = ($page - 1) * $post_per_page ;

if (isset($_GET["user_id"])&&$_SESSION["user"]["id_role"]==3) {

		$nb_post = getpage_user($_GET["user_id"]);
		$post_per_page = 5;
		$number_page = ceil($nb_post/$post_per_page);
		$post_user = getpostuser($_GET["user_id"],$first_message,$post_per_page);
	



}
else {
	secure_session($_SESSION["user"]["user_id"],"Vous ne pouvez pas acc&eacute;der &agrave; cette ressource car vous n'&ecirc;tes pas connect&eacute;, ou connect&eacute; sous un autre compte !");

	$nb_post = getpage_user($_SESSION["user"]["user_id"]);
	$number_page = ceil($nb_post/$post_per_page);



	$post_user = getpostuser($_SESSION["user"]["user_id"],$first_message,$post_per_page);
}




?>

