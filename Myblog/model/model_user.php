<?php 
function sign_up($mail,$password,$name,$firstname,$nickname) {
	global $link;
	$query="INSERT INTO `users` (user_mail,user_password,user_name,user_firstname,user_nickname) VALUES (?,?,?,?,?)";
		if ($stmt=mysqli_prepare($link,$query)){
			mysqli_stmt_bind_param($stmt,"sssss",$mail,md5($mail.$password."toto"),$name,$firstname,$nickname);
			mysqli_stmt_execute($stmt);
			$result=(mysqli_stmt_affected_rows($stmt));
			mysqli_stmt_reset($stmt);
		} 
}



function update_user($user_lastconnect,$user_id) {
		global $link;
		$query="UPDATE `users` SET `user_lastconnect`=? WHERE `user_id`=?";
		if ($stmt=mysqli_prepare($link,$query))
			{
				mysqli_stmt_bind_param($stmt,"ss",$user_lastconnect,$user_id);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
				return(TRUE);
			}
		else
			{return(FALSE);}

}


function getuserpage() {

		global $link;
		$query="SELECT COUNT(user_id) as nb_elem FROM users";
		$result=mysqli_query($link,$query);
		$data=mysqli_fetch_all($result,MYSQLI_ASSOC);
		return($data[0]["nb_elem"]);
}

function getusersinfo($first_user,$user_per_page) {

	global $link;
	$query="SELECT user_id,users.id_role,user_nickname,roles.role FROM users LEFT JOIN roles ON roles.id_role=users.id_role WHERE users.id_role !=3 AND users.deleted != 1 LIMIT ?,?";
	if ($stmt=mysqli_prepare($link,$query)) {

		mysqli_stmt_bind_param($stmt,'ii',$first_user,$user_per_page);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$user_id,$id_role,$nickname,$role);
		mysqli_stmt_store_result($stmt);

	}
	$users=array();
	while (mysqli_stmt_fetch($stmt)) {
		$users[]=array('id' => $user_id , 'id_role' => $id_role, 'nickname' => $nickname, 'role' => $role );
	}
	


	return($users);
}

function connect($mail,$password) {

	global $link;
	$query="SELECT `user_id`,`user_mail`,`user_nickname`,`user_lastconnect`,`id_role`,`deleted` from `users` WHERE user_mail=? AND user_password=?";

		if ($stmt=mysqli_prepare($link,$query))
			{
				mysqli_stmt_bind_param($stmt,"ss",$mail,md5($mail.$password."toto"));
				if (mysqli_stmt_execute($stmt)){
					$result=mysqli_stmt_get_result($stmt);
					$user=mysqli_fetch_array($result, MYSQLI_ASSOC);
					// Existence dans la base de données :
					if ((!empty($user))&&($user['deleted'] != 1))
						{	
							$user["user_lastconnect"]=date("Y-m-d H:i:s",time());
							mysqli_stmt_close($stmt);
							update_user($user["user_lastconnect"],$user["user_id"]);
							$_SESSION["user"]=$user;
							return(TRUE);							
						}
					else
						{
							return(FALSE);
						}
						
					
					
				}
			}
		
}

function deleteuser($id){

	global $link;
	$query='UPDATE users SET deleted =1,
			user_nickname = "profil supprimer",
			user_name = "",user_firstname="" WHERE user_id =?';
	if ($stmt=mysqli_prepare($link,$query)) {

		mysqli_stmt_bind_param($stmt,'i',$id);
		mysqli_stmt_execute($stmt);
		$result=(mysqli_stmt_affected_rows($stmt));
		return($result);
		mysqli_stmt_close($stmt);
	}


}

function updaterole($role,$id) {

	global $link;
	$query="UPDATE `users` SET `id_role`=? WHERE `user_id`=?";
	if ($stmt=mysqli_prepare($link,$query)) {

		mysqli_stmt_bind_param($stmt,'ss',$role,$id);
		mysqli_stmt_execute($stmt);
		$result=(mysqli_stmt_affected_rows($stmt));
		return($result);
		mysqli_stmt_close($stmt);
	}

}



?>