<?php
session_start();
date_default_timezone_set('Europe/Paris');
$link=mysqli_connect('localhost','root','','ghibli_blog');

if ($link===FALSE)
	die(mysqli_connect_error());

include('model/model_blog.php');
include("secure.php");
$topcomment=getmostcommented();
$posts_ids=all_post_id();
$comments_ids=all_comm_id();
$users_id=all_user_id();

if (!isset($_GET["top_blog"]))
	{
		$_GET["top_blog"]="commentaire";
	}

if ($_GET["top_blog"]=="commentaire")
	{
		$topblog=gettopblogcomm();
	}
else
	{
		$topblog=gettopblogpost();
	}

$query_str=str_replace("top_blog=commentaire&","",$_SERVER["QUERY_STRING"] );
$query_str=str_replace("top_blog=billet&","",$query_str );

if (isset($_SESSION["user"]))
	{
		$posts_by_user=all_post_id_user();
		$comm_by_user=all_comm_id_user();
	}

if (!isset($_GET["action"]))
	{
		include('getlastpost.php');
	}
else
	{
		switch ($_GET["action"])
			{
				case 'updatepost':
					include('updatepost.php');
					include('getlastpost.php');
					break;
				case 'getpostuser' :
					include('getpostuser.php');
					break;
				case 'addcomment' :
					include('addcomment.php');
					include('getcomment.php');
					break;
				case 'sign_up_succeed' : 
					include('getlastpost.php');
					break;
				default:
					if (isset($_GET["action"]))
						{
							include($_GET["action"].".php");
						}
					include('getlastpost.php');
					break;
			}	
	}


/*if (isset($_GET["action"]))
	{
		if (($_GET["action"]=="updatepost"))
			{
				if ((isset($_GET["action"]))&&($_GET["action"]=="updatepost")&&(!in_array($_POST["post_id"],$post_by_user)))
				{
					$_SESSION['secure']="Vous ne pouvez pas accéder à la ressource/action que vous demandez, vous avez été redirigé sur la page d'accueil !";
					header('Location: index.php ' );
					die();
				}

				include($_GET["action"].".php");
				include("getlastpost.php");
				
			}
		elseif ($_GET["action"]=="getpostuser")
			include($_GET["action"].".php");
		elseif ((isset($_GET["view"]))&&($_GET["view"]=="updatepost"))
			include("getpostbyid.php");
		elseif ($_GET["action"]=="addcomment")
				{	
					include("addcomment.php");
					include("getcomment.php");
				}
		else {
			include($_GET["action"].".php");
			include("getlastpost.php"); }
	}
else
	include("getlastpost.php");*/


if (isset($_GET["view"]))
	{

		switch ($_GET["view"])
			{
				case 'comment':
					include ("getpostbyid.php");	
					include("getcomment.php");
					break;
				
				case 'updatecomment':
					include ("getpostbyid.php");
					break;

				case 'updatepost':
					include ("getpostbyid.php");
					break;
				case 'admin' :
					include('getusersinfo.php');
					break;
			}
	}

/*if ((isset($_GET["view"]))&&$_GET["view"]=="comment")
	{
		include ("getpostbyid.php");	
		include("getcomment.php");

	}

if ((isset($_GET["view"]))&&$_GET["view"]=="updatecomment")
	{
		include ("getpostbyid.php");
			


	}*/

include("views/view.php");

unset($_SESSION["secure"]);
?>