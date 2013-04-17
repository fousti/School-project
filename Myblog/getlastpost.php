<?php
require_once('model/model_post.php');

$nb_post = getpage("posts");
$post_per_page = 5;
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

$post = getlastpost($first_message, $post_per_page);

?>