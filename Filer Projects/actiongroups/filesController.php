<?php
require_once('/../models/files.model.php');
require_once('/../models/directory.model.php');

if (!empty($_GET['dir'])) {

	$path = $config['root'].$_GET['dir'];
	

}
elseif (!empty($_POST['path'])) {

	$path = $config['root'].$_POST['path'];

}
else {

	$path = $config['root'];
}


if ($action == 'deletefile') {
	if (file_exists($config['root'].$_GET['file'])) {
		
		delete_file($config['root'].$_GET['file']);	
	}
		
	$path = $config['root'].$_GET['file'];
	$pos = strrpos($path, '/');
	$path = substr($path, 0,$pos);

}

if ($action == 'createfile') {


	if (!((!empty($_POST['new_file']))&&(!file_exists($path.'/'.$_POST['new_file']))&&(!strrpos($_POST['new_file'],'/')&&create_file($path.'/'.$_POST['new_file'])))) {

	

		$error['createfile'] = 'Wrong file name ! ';

	} 
}

if ($action == 'movefile') {

	move($path,$config['root'].$_POST['new_path'].'/'.$_POST['filename']);

	$pos = strrpos($path, '/');
	$path = substr($path, 0,$pos);

}

if ($action == 'copyfile') {
	
	copy_file($path,$config['root'].$_POST['new_path'].'/'.$_POST['filename']);

	$pos = strrpos($path, '/');
	$path = substr($path, 0,$pos);


}

if ($action == 'renamefile' ) {

	if (!strpos($_POST['new_path'],'/')) {
		move($path,$config['root'].$_POST['dir'].'/'.$_POST['new_path']);

	}
	else {
		$error['renamefile'] = "Wrong file name !";
	}

	$path = $config['root'].$_POST['dir'];

}


	if ($action == 'uploadfile') {

		$result = uploadFile($path);
		if (( $result === false) || is_string($result)) {
	
			$content = my_readdir($path);
			$content_folder = get_content_folder($config['root']);
			$error['uploadfile'] = $result;
		}
		elseif ($result === true) {
		
			$content = my_readdir($path);
			$content_folder = get_content_folder($config['root']);
			$error['uploadfile'] = 'File successfully uploaded !';

		}

	}

	if ($action == 'download') {
		if (!empty($_GET['file'])) {

			$path = $config['root'].$_GET['file'];
			if (DownloadFile($path) !== false) {
				$error['downloadfile'] = 'File successfully downloaded !' ;
			}
			else {
				$error['downloadfile'] = 'An error occured, please try again !' ;
			}

			$pos = strrpos($path, '/');
			$path = substr($path, 0,$pos);

		}
	}

if ($action == 'read') {

	$path = $config['root'].$_GET['file'];
	$file = read_file($path);
	$path = url_enc($path);
}

if ($action == 'edit') {

	edit_file($path,$_POST['content']);
	$pos = strrpos($path, '/');
	$path = substr($path, 0,$pos);

}


#########################################
#										#
# View variable, path, and encode path	#
#										#
#########################################




if ($action != 'read') {

	$content = my_readdir($path);
	$content_folder = get_content_folder($config['root']);
	$tree=get_content_folder($config['root']);
	$name=array();
	$lvl=array();
	$atree=array();
	foreach($tree as $key => $value){

			$info=pathinfo($value);
			$name_tree[$value]=$info['filename'];
			$lvl[$value]=substr_count($value, "/");

		}
	$path = url_enc($path);


	foreach ($content_folder as $key => $value) {
		
		if ($content_folder[$key] == $config['root']) {
			$content_folder[$key] = 'root' ;
		}
		else {

			$content_folder[$key] = url_enc($content_folder[$key]);
		}

	}

}

?>