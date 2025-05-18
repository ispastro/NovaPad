<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json";)

require_once '../config/database.php';
require_once '../core/fileManager.php'
require_once '../core/helpers.php'


$fileManager =new FileManager("../files", "../versions");
$file new File($db);


$data =json_decode(file_get_contents('php://input'), true);

if(!empty($data->filename)){
$file->filename=htmlspecialchars(strip_tags($data->filename));
if($file->delete()){
    // delete from  the file system
    $deleted =$fileManager->delete($file->filename);
    if($deleted){
        echo json_encode(["message"=>"file deleted successfully"])

    }
    else {
        echo json_encode(["message"=>"Failed to delete from the database"]);
    
    }
}
else {
    echo json_encode(["message"=>"File name required"]);
}
}

?>









?>