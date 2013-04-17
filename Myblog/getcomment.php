<?php 
require_once('model/model_comment.php');

secure_id($_GET["post_id"], $posts_ids, "Vous ne pouvez pas acc&eacute;der &agrave; la ressource/action que vous demandez, vous avez &eacute;t&eacute; redirig&eacute; sur la page d'accueil 3");
$comment = getcomment($_GET["post_id"]);

?>