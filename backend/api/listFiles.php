<?php


require_once '../config/config.php';
require_once '../core/helpers.php';
require_once '../core/fileManager.php';
// Creating the object of file manager 
$fileManager =new FileManager(BASE_PATH, VERSION_PATH);


// get th elists of the files

$files =$fileManager->listFiles();



// check if the file is empty


if(empty($files)){
    jsonResponse( 'success','File not found', []);
}
else {
    jsonResponse('success', 'Files listed successfully!', $files);
}


?>

