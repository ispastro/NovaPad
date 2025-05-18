<?php
header("Access-Control-Allow-Origin: *"); // Or restrict to your frontend domain
header("Access-Control-Allow-Methods: POST, GET, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require_once '../core/helpers.php';
require_once '../core/fileManager.php';
require_once '../models/File.php';
require_once '../config/database.php';





$data = json_decode(file_get_contents('php://input'), true);




if(empty($data['filename']) || empty($data['content'])){
    jsonResponse("error", "File name or content is missing.");
}

$filename = sanitizeFileName($data['filename']);
$content = $data['content'];


$fileManager =new FileManager(BASE_PATH, VERSION_PATH);


if(!$fileManager->save($filename, $content)){
    jsonResponse("error", "file  couldn't be saved");
} 
try{
    $db =(new Database())->getConnection();
    $file =new File($db);
    $file->filename=$filename;
    $file->content=$content;

    if(!$file->create()){
        jsonResponse("warning", "File saved to disk, but failed to store to the database");
    }
    jsonResponse("success", "File saved successfully, and metadata stored.");

}
catch(Exception $e){
    jsonResponse("warning", "file Saved , but database error:".$e->getMessage());

}
?>

