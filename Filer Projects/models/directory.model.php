<?php
require_once('/../models/users.model.php');
// Lit un répertoire et retourne son contenu sous forme de tableau :
function my_readdir($dirpath) {
	$result= array();
	if ($handle=opendir($dirpath)) {
	    while (false !== ($entry = readdir($handle))) {
	 			if (is_dir($dirpath."/".$entry)) {

	 				$result['dir'][] = $entry ;

	 			}
	 			else {
	 				$result['file'][] = $entry ;
	 			}
	    	}
		}
	$result['dir'] = array_diff($result['dir'],array('.' ,'..' ));
	return($result);
}

function create_dir($dirpath,$dirname) {

		if ((strpos($dirname, '/.') === false)&&(strpos($dirname, '/..') === false)&&(strpos($dirname, '/') === false)&&(!file_exists($dirpath.'/'.$dirname))&&(is_dir($dirpath))) {
			if (isset($_SESSION['user']))
				log_action('create_dir',$dirpath.'/'.$dirname,$dirname,$_SESSION['user']['id_user']);
			
			return (mkdir($dirpath.'/'.$dirname));
		}
		else{
			return(false);
		}
}
		
function remove_dir($dirpath) {
	log_action('delete_directory',$dirpath,'',$_SESSION['user']['id_user']);
	foreach (glob($dirpath."/*") as $file) {
		if (is_dir($file)) {
			remove_dir($file);
		}
		else {
			log_action('delete_file',$dirpath,$file,$_SESSION['user']['id_user']);
			unlink($file) ;
		}
	}
	rmdir($dirpath);
}

function valid_dirpath($path,$root) {


	return(!((strpos(realpath($path),realpath($root)) === 0)||(strpos($path,'/'))||strpos($path,'/.')||strpos($path,'/..')));

}




function move($dirpath,$dirnewpath) {
	log_action('move',$dirpath,$dirnewpath,$_SESSION['user']['id_user']);	
	return(rename($dirpath,$dirnewpath));	

}


function get_content_folder($path) {
	$result = array();
	if ($handle = opendir($path)) {
		while (false !== ($entry = readdir($handle))) {
			if (is_dir($path.'/'.$entry)) {
				if ($entry != '.' && $entry != '..') {
					$result[] = $path.'/'.$entry ;
					$result2 = get_content_folder($path.'/'.$entry);
					$result = array_merge($result,$result2);
				}			
			}
		}
	}
	return($result);
}

function copy_dir($pathfolder,$dest,$path) {

	if($pathfolder == $dest){ 
		$i=0;
		while(is_dir($dest)){ 
			$info=pathinfo($dest);
			if($i == 0){
				$copy=" - Copy";
				$num="";
			}
			elseif($i > 0){
				$copy="";
				$num="(".$i.")";
				$info['filename']=str_replace("(".($i-1).")","",$info['filename']);
			}
			$dest=$path."/".$info['filename'].$copy.$num;
			$i++;
		}
	}

	if (is_dir($pathfolder)) {
		log_action('copy_directory',$pathfolder,$dest,$_SESSION['user']['id_user']);
		mkdir($dest);
		$dir = my_readdir($pathfolder);
		if (count($dir['dir'] > 0)) {
			foreach ($dir["dir"] as $file) {
				copy_dir($pathfolder.'/'.$file,$dest.'/'.$file,$path);
			}			
		}
		if (isset($dir['file'])) {
			foreach ($dir['file'] as $file) {
				log_action('copy_file',$pathfolder.'/'.$file,$dest.'/'.$file,$_SESSION['user']['id_user']);
				copy($pathfolder.'/'.$file,$dest.'/'.$file);
			}
		}
		
		return(true);
	}

}




?>