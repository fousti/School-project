<?php

if (isset($_POST['disconnect']) && !empty($_POST['disconnect'])) 
		{
			$_SESSION = array();
			session_unset();
			session_destroy();
			header('Location: ' . $_SERVER['HTTP_REFERER']); 
			exit;
		}
?>

