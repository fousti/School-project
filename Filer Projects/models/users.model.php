<?php 
function sign_up($mail,$password,$name) {

	global $link;
	$query="SELECT `id_user` FROM `users` WHERE `mail` = ? ";
	if ($stmt = mysqli_prepare($link,$query)) {
		mysqli_stmt_bind_param($stmt,'s',$mail);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		$result = mysqli_stmt_num_rows($stmt);
		mysqli_stmt_reset($stmt);
	}

	if ($result != 0) {

		return(FALSE);
	}


	$query="INSERT INTO `users` (mail,password,name,created,last_connect) VALUES (?,?,?,NOW(),NOW())";
		if ($stmt=mysqli_prepare($link,$query)){
			mysqli_stmt_bind_param($stmt,"sss",$mail,md5($mail.$password."filer"),$name);
			mysqli_stmt_execute($stmt);
			$result=(mysqli_stmt_affected_rows($stmt));
			mysqli_stmt_reset($stmt);
		} 

	return($result);
}

function update_user($id) {

	global $link;
	$query="UPDATE `users` SET `last_connect`=NOW() WHERE `id_user`=?";
	if ($stmt=mysqli_prepare($link,$query))
			{
				mysqli_stmt_bind_param($stmt,"s",$id);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
				return(TRUE);
			}
	else
			{return(FALSE);}
}


function connect($mail,$password) {

	global $link;
	$query="SELECT `id_user`,`mail`,`name`,`last_connect` FROM `users` WHERE mail=? AND password=?";

		if ($stmt=mysqli_prepare($link,$query))
			{
				mysqli_stmt_bind_param($stmt,"ss",$mail,md5($mail.$password."filer"));
				if (mysqli_stmt_execute($stmt)){
					$result=mysqli_stmt_get_result($stmt);
					$user=mysqli_fetch_array($result, MYSQLI_ASSOC);
					mysqli_stmt_close($stmt);
					// Existence dans la base de données :
					if (!empty($user))
						{	
							
							$_SESSION["user"]=$user;
							$_SESSION['user']['last_connect'] = date_format(date_create($_SESSION['user']['last_connect']),"d/m/y H:i");
							update_user($user["id_user"]);
							return(TRUE);							
						}
					else
						{
							return(FALSE);
						}
						
					
					
				}
			}
}

function log_action($action,$element,$params,$id_user) {
	global $link;
	$query="INSERT INTO `log`(`action`, `element`, `params`,`date`, `id_user`, `IP_user`) VALUES (?,?,?,NOW(),?,?)";
	if ($stmt = mysqli_prepare($link,$query)) {
		$ip_user = $_SERVER['REMOTE_ADDR'];
		mysqli_stmt_bind_param($stmt,'sssis',$action,$element,$params,$id_user,$ip_user);
		if (mysqli_stmt_execute($stmt)) {
			mysqli_stmt_close($stmt);
			return(TRUE);

		}
		else {
			return(FALSE);
		}
	}
}



?>