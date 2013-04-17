<?php
function update_post($title,$content,$post_id) {

	global $link;
	$query="UPDATE `posts` set title=?,content=?,updated=? WHERE post_id=?";
	if ($stmt=mysqli_prepare($link,$query))
	{
		$updated=date('Y-m-d H:i:s');
		mysqli_stmt_bind_param($stmt,"ssss",$title,$content,$updated,$post_id);
		mysqli_stmt_execute($stmt);
		$result=(mysqli_stmt_affected_rows($stmt));
		mysqli_stmt_reset($stmt);	
	}
}





function getpage_user($id_user) {
	global $link;
	$query="SELECT COUNT( * ) AS nb_post
	FROM `posts`
	LEFT JOIN users ON users.user_id = posts.id_user
	WHERE posts.id_user = ".$id_user;
	$result=mysqli_query($link,$query);
	$data=mysqli_fetch_all($result,MYSQLI_ASSOC);
	return($data[0]["nb_post"]);
}






// La fonction getpage prends paramètres le nom de la table et renvoie le nombre total d'élements de la table dans la BDD.
//type des arguments = $table : string
// Type de retour = integer.
function getpage($table) {
	
	global $link;
	$query="SELECT COUNT(*) as nb_elem FROM ".$table;
	$result=mysqli_query($link,$query);
	$data=mysqli_fetch_all($result,MYSQLI_ASSOC);
	return($data[0]["nb_elem"]);

}

function add_post($title,$content,$id_user) {
	global $link;
	$query="INSERT INTO `posts` (title,content,id_user) VALUES (?,?,?)";

	if ($stmt=mysqli_prepare($link,$query))
			{
				mysqli_stmt_bind_param($stmt,"ssi",$title,$content,$id_user);
				mysqli_stmt_execute($stmt);
				$result=(mysqli_stmt_affected_rows($stmt));
				mysqli_stmt_reset($stmt);
				
			}
}

function delete_post($post_id) {
	global $link;
	$query="DELETE p.*, c.*
	FROM posts p
	LEFT JOIN comments c ON c.post_id=p.post_id
	WHERE p.post_id=?"; 
	if ($stmt=mysqli_prepare($link,$query))
		{
			mysqli_stmt_bind_param($stmt,"i",$post_id);
			mysqli_stmt_execute($stmt);
			$result=(mysqli_stmt_affected_rows($stmt));
			mysqli_stmt_close($stmt);
		}
}



// la fonction getpostbyId prend en paramètre l'identifiant d'un billet en BDD et renvoie sous forme de tableau associatif les informations du billets ainsi que son contenu.
// type argument = $post_id : int
// type de retour = $post : array

function getpostbyId($post_id) {
	global $link;
	$query="SELECT `posts`.`title` , `posts`.`content` , `posts`.`created` , `posts`.`updated` , `posts`.`id_user` , `users`.`user_nickname` , `posts`.`post_id` , COUNT( comments.comm_id ) AS nbrcomment
	FROM `posts`
	LEFT JOIN `users` ON `users`.`user_id` = `posts`.`id_user`
	LEFT JOIN comments ON comments.post_id = `posts`.post_id
	WHERE `posts`.`post_id` =?";

	if ($stmt=mysqli_prepare($link,$query))
			{
				mysqli_stmt_bind_param($stmt,"s",$post_id);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt,$title,$content,$created,$updated,$id_user,$user_nickname,$post_id,$nbrcomment);
			}

	$post=array();
	$i=0;

	while (mysqli_stmt_fetch($stmt))
		{
			$created=date_create($created);
			$created=date_format($created,"d/m à h:i");
			if ($updated!="0000-00-00 00:00:00") {
				$updated=date_create($updated);
				$updated=date_format($updated,"d/m à h:i");
			}
			else
				$updated="";

			$post[$i]=array("post_id"=>$post_id,"created"=>$created,"updated"=>$updated,"title"=>$title,"content"=>$content,"id_user"=>$id_user,"user_nickname"=>$user_nickname,"post_id"=>$post_id,"nbrcomment"=>$nbrcomment);
			$i++;
		}
		
	mysqli_stmt_free_result($stmt);
	mysqli_stmt_reset($stmt);
	return($post);

}



// La fonction getlastpost prends en paramètres le numéro (sa place dans la base de données lors du SELECT) du premier message à afficher et le nombre de messages à afficher par page et renvoie les 5 post classés par date de création
// sous forme de tableau associatif.
//type des arguments = int,int
// type de retour = array


function getlastpost($first_message,$post_per_page) {

	global $link;
	$query="SELECT `posts`.`title` , `posts`.`content` , `posts`.`created` , `posts`.`updated` , `id_user` , `users`.`user_nickname` , `posts`.`post_id` , COUNT( comments.comm_id ) AS nbrcomment
	FROM `posts`
	LEFT JOIN `users` ON `users`.`user_id` = `posts`.`id_user`
	LEFT JOIN comments ON comments.post_id = posts.post_id
	GROUP BY posts.post_id
	ORDER BY `created` DESC
	LIMIT ?,?";
	if ($stmt=mysqli_prepare($link,$query))
			{
				mysqli_stmt_bind_param($stmt,'ii',$first_message,$post_per_page);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt,$title,$content,$created,$updated,$id_user,$user_nickname,$post_id,$nbrcomment);
				mysqli_stmt_store_result($stmt);
				
			}

	$post=array();
	$i=0;

	while (mysqli_stmt_fetch($stmt))
		{
			$created=date_create($created);
			$created=date_format($created,"d/m à h:i");
			if ($updated!="0000-00-00 00:00:00") {
				$updated=date_create($updated);
				$updated=date_format($updated,"d/m à h:i");
			}
			else
				$updated="";

			$post[$i]=array("post_id"=>$post_id,"created"=>$created,"updated"=>$updated,"title"=>$title,"content"=>$content,"id_user"=>$id_user,"user_nickname"=>$user_nickname,"post_id"=>$post_id,"nbrcomment"=>$nbrcomment);
			$i++;
		}

	mysqli_stmt_free_result($stmt);
	mysqli_stmt_reset($stmt);
	return($post);

}


function getpostuser($id_user,$first_message,$post_per_page) {

	global $link;
	$query="SELECT p . * , COUNT( comments.comm_id ) AS nbrcomment, u.user_nickname
	FROM `posts` AS p
	LEFT JOIN comments ON comments.post_id = p.post_id
	LEFT JOIN users u ON p.id_user = u.user_id
	WHERE p.id_user =?
	GROUP BY p.post_id
	ORDER BY `created` DESC
	LIMIT ?,?"; //Selectionne tous les posts d'un User

	if ($stmt=mysqli_prepare($link,$query))
			{
				mysqli_stmt_bind_param($stmt,"iii",$id_user,$first_message,$post_per_page);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt,$post_id,$created,$updated,$title,$content,$id_user,$nbrcomment,$nickname);	
				mysqli_stmt_store_result($stmt);
			}

	$post_user=array();
	$i=0;

	while (mysqli_stmt_fetch($stmt))
		{
			$created=date_create($created);
			$created=date_format($created,"d/m à h:i");
			if ($updated!="0000-00-00 00:00:00") {
				$updated=date_create($updated);
				$updated=date_format($updated,"d/m à h:i");
			}
			else
				$updated="";

			$post_user[$i]=array("post_id"=>$post_id,"created"=>$created,"updated"=>$updated,"title"=>$title,"content"=>$content,"id_user"=>$id_user,"nbrcomment"=>$nbrcomment,"nickname" => $nickname);
			$i++;
		}
		
	mysqli_stmt_free_result($stmt);
	mysqli_stmt_reset($stmt);
	return($post_user);

}

?>