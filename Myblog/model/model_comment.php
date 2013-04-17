<?php
function add_comment($content,$post_id,$user_id) {
	global $link;
	$query="INSERT INTO `comments` (content,post_id,comm_user_id) VALUES (?,?,?)";
	if ($stmt=mysqli_prepare($link,$query))
		{
			mysqli_stmt_bind_param($stmt,"sii",$content,$post_id,$user_id);
			mysqli_stmt_execute($stmt);
			$result=(mysqli_stmt_affected_rows($stmt));
			mysqli_stmt_close($stmt);	
		}
}

function delete_comment($comm_id) {
	global $link;
	$query="DELETE c.*
	FROM comments c 
	WHERE c.comm_id=?"; 
	if ($stmt=mysqli_prepare($link,$query))
		{
			mysqli_stmt_bind_param($stmt,"i",$comm_id);
			mysqli_stmt_execute($stmt);
			$result=(mysqli_stmt_affected_rows($stmt));
			mysqli_stmt_close($stmt);
		}
}

// La fonction getcommentbyId prends en paramètre l'identifiant d'un commentaire et renvoie sous forme de tableau associatif les informations du commentaire de la BDD et son contenu ainsi que le 'nickname' de l'auteur.
// Type des arguments = $id : String 
// Type de retour = array.
function getcommentbyId($id) {

	global $link;
	$query="SELECT `content`,`comm_id`,`date_create`,`comments`.`updated`,`comm_user_id`,`users`.`user_nickname`,`post_id` from `comments` LEFT JOIN `users` ON `users`.`user_id`=`comments`.`comm_user_id` WHERE `comm_id`=?";
	if ($stmt=mysqli_prepare($link,$query))
		{
			mysqli_stmt_bind_param($stmt,"s",$id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			mysqli_stmt_bind_result($stmt,$content,$comm_id,$date_create,$updated,$id_user,$user_nickname,$post_id);
		}

	$comment=array();
	$i=0;

	while (mysqli_stmt_fetch($stmt))
		{
			$date_create=date_create($date_create);
			$date_create=date_format($date_create,"d/m à h:i");
			if ($updated!="0000-00-00 00:00:00")
				{
					$updated=date_create($updated);
					$updated=date_format($updated,"d/m à h:i");
				}
			else
				$updated="";

			$comment[$i]=array("post_id"=>$post_id,"comm_id"=>$comm_id,"date_create"=>$date_create,"content"=>$content,"user_id"=>$id_user,"user_nickname"=>$user_nickname);
			$i++;
		}
		
	mysqli_stmt_free_result($stmt);
	mysqli_stmt_reset($stmt);
	return($comment);
}

// La fonction getcomment prend en paramètre l'identifiant d'un billet et renvoie l'ensemble des commentaires sous forme de tableau associatif associé au billet.
//type des arguments = $post_id : string
//type de retour = $comment : array 

function getcomment($post_id) {

	global $link;
	$query="SELECT `comm_id` , `date_create`,`comments`.`updated` , `comments`.`content` , `comm_user_id` ,`comments`.`post_id`, `users`.`user_nickname` 
	FROM `comments`
	LEFT JOIN `posts` ON `comments`.`post_id` = `posts`.`post_id`
	LEFT JOIN `users` ON `comments`.`comm_user_id` = `users`.`user_id`
	WHERE `posts`.`post_id` =?";
	$stmt=mysqli_prepare($link,$query);
	echo(mysqli_error($link));
	if ($stmt)
		{
			mysqli_stmt_bind_param($stmt,"s",$post_id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$comm_id,$date_create,$updated,$content,$comm_user_id,$post_id,$author);
			mysqli_stmt_store_result($stmt);
		}

	$comment=array();
	$i=0;
	while (mysqli_stmt_fetch($stmt))
		{
			$date_create=date_create($date_create);
			$date_create=date_format($date_create,"d/m à h:i");
			if ($updated!="0000-00-00 00:00:00")
				{
					$updated=date_create($updated);
					$updated=date_format($updated,"d/m à h:i");
				}
			else
				$updated="";

			$comment[$i]=array("comm_id"=>$comm_id,"date_create"=>$date_create,"updated"=>$updated,"content"=>$content,"user_id"=>$comm_user_id,"post_id"=>$post_id,"author"=>$author);
			$i++;
		}
	mysqli_stmt_free_result($stmt);
	mysqli_stmt_close($stmt);
	return($comment);
}


function update_comment($content,$comm_id) {

	global $link;
	$query="UPDATE `comments` set content=?,updated=? WHERE comm_id=?";
	if ($stmt=mysqli_prepare($link,$query))
	{
		$updated=date('Y-m-d H:i:s');
		mysqli_stmt_bind_param($stmt,"sss",$content,$updated,$comm_id);
		mysqli_stmt_execute($stmt);
		$result=(mysqli_stmt_affected_rows($stmt));
		mysqli_stmt_reset($stmt);	
	}
}

?>