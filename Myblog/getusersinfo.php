<?php 
require_once('model/model_user.php');

$nb_post = getuserpage();
$post_per_page = 10;
$number_page = ceil($nb_post/$post_per_page);

if (isset($_GET["page"]))
	{
		$page = $_GET["page"];
	}
else
	{
		$page = 1;
	}
	
$first_message = ($page - 1) * $post_per_page ;


$users=getusersinfo($first_message,$post_per_page);


?>