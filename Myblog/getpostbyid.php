<?php
require_once('model/model_post.php');

secure_id($_GET["post_id"],$posts_ids,"Vous ne pouvez pas acc&eacute;der &agrave; la ressource/action que vous demandez, vous avez &eacute;t&eacute; redirig&eacute; sur la page d'accueil ! 5");
$post = getpostbyId($_GET["post_id"]);

 ?>