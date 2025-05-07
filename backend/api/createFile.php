<?php


head("Access-Control-Allow-Origin");
head("Content-Type:application/json");
include_once("../config/database.php");
include_once("../models/File.php");




// create instance of the database 

$database =new Database();
$db=$database->connect();


$file = new File($db);  //this creates the file object and gives it access



$data =json_decode(file_get_contents("input://php"));
if(!empty(filename) && isset($data->content)){
    $file->filename =$data->filename;
    $file->content=$data->content;

    if($file->create()){
        echo json_encode("message"    =>" file created successfully");

    }
    else{
        echo json_encode("message"=>"sth went wrong");
    }


}
esle{
    echo json_encode("message"=>"Incomplete data");

}

?>


