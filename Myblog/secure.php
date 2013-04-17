<?php 
$get_param = array("addcomment","addpost","connect","deletecomment","deletepost",
				"disconnect","getcomment","getcommentbyid","getlastpost","getpostbyid","getpostuser",
				"post","signup","updatecomment","updatepost","inscription","comment","billet","commentaire","sign_up_succeed","updaterole","deleteuser");
$get_keys = array("action","view","post_id","comm_id","page",'top_blog','user_id');

if (isset($_GET["action"]) && (!empty($_GET["action"])))
	{
		foreach ($_GET as $key => $value) {

			if (!in_array($key,$get_keys))
				{	
					$_SESSION['secure']="Vous ne pouvez pas acc&eacute;der &agrave; la ressource/action que vous demandez, vous avez &eacute;t&eacute; redirig&eacute; sur la page d'accueil ! 1";
					header('Location: index.php ' );
					die();
				}

			if (($key != "post_id") && ($key != "comm_id") && ($key != "page") && ($key != 'user_id') && (!in_array($value,$get_param)))
				{	
					$_SESSION['secure'] = "Vous ne pouvez pas acc&eacute;der &agrave; la ressource/action que vous demandez, vous avez &eacute;t&eacute; redirig&eacute; sur la page d'accueil ! 2";
					header('Location: index.php ' );
					die();
				}
		}
	}




function secure_session($id_user,$error_message) {

	if (!isset($id_user))
	{
		$_SESSION["secure"]=$error_message;
		header('location: index.php');
		die();
	}
}

function secure_id($id,$array_id,$error_message) {

	if (!in_array($id, $array_id))
	{
		$_SESSION['secure']=$error_message;
		header('Location: index.php ' );
		die();
	}

}

function in_db($nickname,$mail) {
	
	global $link;
	$query="SELECT `user_nickname` , `user_mail`
			FROM `users`
			WHERE `user_nickname`=? 
			OR `user_mail`=? ";

	if ($stmt=mysqli_prepare($link,$query))
	{
		mysqli_stmt_bind_param($stmt,'ss',$nickname,$mail);
		mysqli_stmt_execute($stmt);
		$result=mysqli_stmt_get_result($stmt);
		$data=mysqli_fetch_array($result);
	}

	return(!empty($data));
}

function all_post_id() {

	global $link;
	$query="SELECT post_id 
			FROM `posts`";
	$posts_ids=array();
	$result=mysqli_query($link,$query);

	while($data=mysqli_fetch_row($result))
		{
			$posts_ids[]=$data[0];
		}

	return($posts_ids);
}

function all_comm_id() {

	global $link;
	$query="SELECT comm_id
			FROM comments";
	$result=mysqli_query($link,$query);
	$comments_ids=array();

	while($data=mysqli_fetch_row($result))
		{
			$comments_ids[]=$data[0];
		}

	return($comments_ids);
}


function all_user_id(){

	global $link;
	$query="SELECT u.user_id FROM users AS u WHERE u.user_id != 3";
	$result=mysqli_query($link,$query);
	$users_id=array();
	while ($data=mysqli_fetch_row($result)) {
		$users_id[]=$data[0];
	}
	return($users_id);
}

function all_post_id_user() {
	global $link;
	$query="SELECT post_id
	FROM `posts`
	WHERE id_user =".$_SESSION["user"]["user_id"];
	$result=mysqli_query($link,$query);
	$post_by_user=array();

	while($data=mysqli_fetch_row($result))
		{
			$post_by_user[]=$data[0];
		}

	return($post_by_user);
}

function all_comm_id_user() {

	global $link;
	$query="SELECT comm_id
			FROM comments
			WHERE comm_user_id =".$_SESSION["user"]["user_id"];
	$result=mysqli_query($link,$query);
	$comm_by_user=array();

	while ($data=mysqli_fetch_array($result))
		{
			$comm_by_user[]=$data[0];	
		}

	return($comm_by_user);
}

?>