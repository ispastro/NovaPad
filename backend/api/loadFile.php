<?php
   header("Access-Control-Allow-Origin: *"); // Or restrict to your frontend domain
header("Access-Control-Allow-Methods: POST, GET, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");


require_once '../config/database';
require_once '../core/FileManager.php';
require_once '../core/helpers.php';
//parse the incoming json


$data =json_decode(file_get_contents('php://input'),true);

//validate input

if(!isset($data['filename'])){
    jsonResponse('error','File name is required');

}

$filename= sanitizeFileName($data['filename']);
$fileManager =new FileManager(BASE_PATH, VERSION_PATH);

try{
    $content= $fileManager->load($filename);

    if($content===false){
        jsonResponse('error', 'File not found or can not be read');

    }
  jsonResponse('success', 'File loaded successfully.', ['content' => $content]);


}
catch(Exception $e){
    jsonResponse('error', 'An error occured while loading the file'.$e->getMessage());

}

?>