<?php 
require_once('/../models/directory.model.php');


if (!empty($_GET['dir'])&&$_GET['dir'] != 'root') {

	$path = $config['root'].$_GET['dir'];
	

}
elseif (!empty($_POST['path'])) {

	$path = $config['root'].$_POST['path'];

}
else {

	$path = $config['root'];
}


if ($action == 'prev_dir') {

	if ($path != $config['root']) {

			$pos = strrpos($path, '/');
			$path = substr($path, 0,$pos);
	}

}


if ($action == 'createdir') {


	if (!create_dir($path,$_POST['dirname'])) {
		
		$error['createdir'] = 'Wrong directory name or directory exist already !' ;

	}
}

if ($action == 'deletedir') {
	if (file_exists($path)&&($path != $config['root'])) {
		remove_dir($path);
	}

	$pos = strrpos($path, '/');
	$path = substr($path, 0,$pos);
	

}

if ($action == 'renamedir') {

	if (valid_dirpath($_POST['new_path'],$config['root'])&&(!empty($_POST['new_path']))&&!file_exists($config['root'].$_POST['dir'].'/'.$_POST['new_path'])) {
		move($path,$config['root'].$_POST['dir'].'/'.$_POST['new_path']);
		$path = $config['root'].$_POST['dir'];
	}
	else {
		$error['renamedir'] = "Wrong new directory name !" ;
	}
}


if ($action == 'movedirectory') {

	if ($_POST['new_path'] == $config['root']) {
		$_POST['new_path'] = '';
	}
	move($path,$config['root'].$_POST['new_path'].'/'.$_POST['dirname']);
	$pos = strrpos($path, '/');
	$path = substr($path, 0,$pos);
	
}

if ($action == 'copydirectory') {

	if ($_POST['new_path'] == $config['root']) {
		$_POST['new_path'] = '';
	}
	copy_dir($config['root'].$_POST['pathfolder'],$config['root'].$_POST['new_path'].'/'.$_POST['dirname'],$path);

}

#########################################
#										#
# View variable, path, and encode path	#
#										#
#########################################

$content = my_readdir($path);
$content_folder = get_content_folder($config['root']);
$name=array();
$lvl=array();

foreach($content_folder as $key => $value){
		$info=pathinfo($value);
		$name_tree[$value]=$info['filename'];
		$lvl[$value]=substr_count($value, "/");

	}
	

foreach ($content_folder as $key => $value) {
	
	if ($content_folder[$key] == $config['root']) {
		$content_folder[$key] = 'root' ;
	}
	else {

		$content_folder[$key] = url_enc($content_folder[$key]);
	}

}

$path = url_enc($path);
?>