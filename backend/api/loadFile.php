<?php
require_once '../config/config.php';
require_once '../core/FileManager.php';
require_once '../core/helpers.php';

$data =json_decode(file_get_contents('php://input'),true);


if(!isset($data['fileName'])){
    jsonResponse('error','filename is required');

}


$fileName = sanitizeFilename($data['fileName']);// to prevent security problems and remove dangerious characters 

$fileManager = new FileManager(BASE_PATH, VERSION_PATH);
$content =$fileManager->load($fileName);// try to read the contents of the file and if it exits you get the text inside if it does not it returns false 


if($content!==false){
    jsonResponse('success','File Loaded', ['content'=>$content]);
}
else {
    jsonResponse('error', 'File Not found');
}



?>










?>