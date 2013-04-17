<?php
require_once('model/model_user.php');

foreach ($_POST as $key=>$elem)
	{
		switch ($key):
			case "prenom" : if (!preg_match('#^[[:alpha:]àéèïî\']{2,}$#', $elem))
								$error_array["form"]["prenom"]="Vous devez remplir le champ \"pr&eacute;nom\" et seulement avec des caract&egrave;res alphab&egrave;tiques !";
							break;
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

if (in_db($_POST["nickname"],$_POST["email"]))
	{
		$error_array["form"]["db"]="Le pseudo et/ou l'adresse email sont d&eacute;j&agrave; utilis&eacute; !";
	}

	
if (empty($error_array["form"]))
	{
		sign_up($_POST["email"],$_POST["pass"],$_POST["nom"],$_POST["prenom"],$_POST["nickname"]);
		header('Location: index.php?action=sign_up_succeed');
		die();
	}

?>