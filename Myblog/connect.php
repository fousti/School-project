<?php
require_once('model/model_user.php');

if (isset($error_array["connect"]))
	unset($error_array["connect"]);

if (empty($_POST["mail"]) || (empty($_POST["password"])))
	{
		$error_array["connect"] = "Login ou mot de passe incorrect !";
	}

if ((!isset($error_array["connect"])) || (empty($error_array["connect"])))
	{
		if (!connect($_POST["mail"],$_POST["password"]))
		{
			$error_array["connect"] =  "Login ou mot de passe incorrect !";
		}
		else
			unset($error_array["connect"]);
			header('Location: '.$_SERVER["HTTP_REFERER"]);
			die();
	}

?>