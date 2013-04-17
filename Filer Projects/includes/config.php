<?php 

$config['db']['user'] = 'root';
$config['db']['pass'] = '';
$config['db']['db_name'] = 'filer';
$config['db']['server'] = 'localhost' ;

$config['routes'] = array('readdir' => 'directory' ,
						   'prev_dir' => 'directory',
						   'createdir' => 'directory',
						   'deletedir' => 'directory', 
						   'renamedir' => 'directory', 
						   	'movedirectory' => 'directory',
						   	'copydirectory' => 'directory',
						   	'deletefile' => 'files',
						   	'createfile' => 'files',
						   	'movefile' => 'files',
						  	'copyfile' => 'files',
						  	'renamefile' => 'files',
						  	'uploadfile' => 'files',
						  	'download' => 'files',
						  	'signup' => 'users',
						  	'connect' => 'users',
						  	'disconnect' => 'users',
						  	'edit' => 'files',
						  	'read' => 'files');

$config['root'] = 'files' ;


?>