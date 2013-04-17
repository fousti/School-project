<?php 
require_once('models/users.model.php');
require_once('models/directory.model.php');

if ($action == 'signup') {

	foreach ($_POST as $key=>$elem)
	{
		switch ($key):
	
			case "nom" :	if (!preg_match('#^[[:alpha:]àéèïî\']{2,}$#', $elem))
								$error_array["form"]["nom"]="Vous devez remplir le champ \"nom\" et seulement avec des caract&egrave;res alphab&egrave;tiques !";
							break; 
			case "email" :	if ((filter_var($elem, FILTER_VALIDATE_EMAIL)) === FALSE)
								$error_array["form"]["email"]="Vous devez remplir le champ \"email\" et il doit contenir @";
							break;
			case "pass" :	if (($elem!=$_POST["verif_pass"]) || (empty($_POST["pass"])) || (strlen($elem)<8))
								{
									$error_array["form"]["pass"]="Veuillez remplir le champ \"mot de passe\" avec au moins 8 caract&egrave;re !";
									$error_array["form"]["verif_pass"]="Veuillez remplir le champ \"v&eacute;rification du mot de passe\" et il doit contenir la m&ecirc;me valeur que le champ \"mot de passe\" !";
								}
							break;
			endswitch;
	}

	if (empty($error_array['form'])) {

		if (sign_up($_POST['email'],$_POST['pass'],$_POST['nom'])) {

			$error['signup'] = "Sign up successful ! You can now Sign in !";
			create_dir($config['root'],$_POST['email']);

		}
		else {

			$error_array['form']['db'] = "Email already use !" ;

		}
	}
	$template = 'signup';
}


if ($action == 'connect') {

	if (empty($_POST['mail'])||empty($_POST['password'])) {

		$error_array['connect'] = "Please fill up the form correctly !" ;
	}

	elseif (!connect($_POST['mail'],$_POST['password'])) {

		$error_array['connect'] = 'Wrong email or password !';
	}
	else {

		header('Location: index.php?action=readdir');
	}
}

if ($action == 'disconnect') {
	if (isset($_POST['disconnect']) && !empty($_POST['disconnect'])) 
		{
			$_SESSION = array();
			session_unset();
			session_destroy();
			header('Location: index.php'); 
			exit;
		}
}
?>