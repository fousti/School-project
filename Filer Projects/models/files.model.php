<?php 
require_once('/../models/users.model.php');

function delete_file($file) {
	log_action('delete_file',$file,'',$_SESSION['user']['id_user']);
	return(unlink($file));
}

function create_file($newfile) {

	if ($handle = fopen($newfile,'w+')) {
		fclose($handle);
		log_action('create_file',$newfile,'',$_SESSION['user']['id_user']);
		return(TRUE);
	}
	else {
		return(false);
	}
}
function copy_file($path,$dest) {

	return(copy($path, $dest));
}


function uploadFile($dest) {

	$userfile_name = $_FILES['file_up']['name']; // file name  
	$userfile_tmp  = $_FILES['file_up']['tmp_name']; // actual location  
	$userfile_size  = $_FILES['file_up']['size']; // file size  
	$userfile_type  = $_FILES['file_up']['type']; // mime type of file sent by browser. PHP doesn't check it.   
	$userfile_error  = $_FILES['file_up']['error']; // any error!. get from here 

	if (($userfile_name != '')&&file_exists($dest.'/'.$userfile_name)) return('File name already exists !');

	switch ($userfile_error) {
	 	case UPLOAD_ERR_NO_FILE:
	 		return('You must select a document to upload before you can save this page.');
	 		break;
	 	case UPLOAD_ERR_FORM_SIZE :
	 		return('The document you have attempted to upload is too large.');
	 		break;
	 	case UPLOAD_ERR_PARTIAL :
	 		return('An error occured while trying to recieve the file. Please try again.');
	 		break;
	 }


	 if (is_uploaded_file($userfile_tmp)) {
	 	log_action('upload',$userfile_name,$dest,$_SESSION['user']['id_user']);
	 	return(move_uploaded_file($userfile_tmp, $dest.'/'.$userfile_name));

	 }
	 else {

	 	return('Not an uploaded file ! please try again');
	 }
	 


}



function DownloadFile($file) {	

	log_action('download',$file,'',$_SESSION['user']['id_user']);
	$file = realpath($file);
	header("Content-Disposition: attachment; filename=" . basename($file));   
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Content-Description: File Transfer");
	header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');            
	header("Content-Length: " . filesize($file));
	$contents = '';
	if ($fp = fopen($file,'rb')){
		while (!feof($fp)) {
			
			$contents .= fread($fp, 1000000);
		}
	}
	fclose($fp);
	echo $contents;
	ob_flush();
	flush();

}

function read_file($file) {

	if ($handle = fopen($file, 'r+')) {
			while (!feof($handle)) {
			$result = fread($handle, 1000000);
		}
	}

	fclose($handle);
	return($result);
}

function edit_file($file,$content) {

	if ($handle = fopen($file, 'w+')){
			if (fwrite($handle, $content) === FALSE) {
			return(FALSE);
		}
		else {
			log_action('edit_file',$file,$content,$_SESSION['user']['id_user']);
			return(TRUE);
		}
	}

}
?>