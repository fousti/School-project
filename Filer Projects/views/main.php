<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Filer v.1</title>
		<meta name="description" content="gestionnaire de fichier">
		<meta name="author" content="Ismael Tifous">
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<link href='http://fonts.googleapis.com/css?family=Iceland' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div class="band"></div>
		<div id="wrapper">
			<?php include('templates/connect.template.php'); ?>
			<?php echo (isset($error[$action])?'<span class="error">'.$error[$action].'</span>':'') ?>
			<?php include('templates/'.$template.'.template.php'); ?>

		</div>
		
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>

