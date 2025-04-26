<?php

require_once '../core/helpers.php';
require_once '../core/fileManager.php';


$data = json_decode(file_get_contents('php://input'), true);




if(!isset($data['fileName']) || !isset($data['content'])){
    jsonResponse("error", "File name or content is missing.");
}

$fileName = sanitizeFileName($data['fileName']);
$content = $data['content'];


$fileManager =new FileManager(BASE_PATH, VERSION_PATH);


if($fileManager->saveFile($fileName, $content)){
    jsonResponse("success", "file saved successfully");
} else {
    jsonResponse("error", "Failed to save the file.");
}


?>