<?php


//hEADERS
header('Accesss-Control-Allow-Origin:*');
header('Content-Type :application/json');

//inlude database and model

include_once('../config/database.php');
include_once('../models/File.php');


//Instantiate DB

$database =new Database();
$db =$database->connect();



// instantiate File object


$file =new File($db);


// get raw posted data

$data =json_decode(file_get_contents('php://input'));
if(!empty($data->fileName) && isset($data->connect)){
    $file->fileName =$data->fileName;
    $file->content=$data->content;


    ($file->create()){
        echo json_decode(["Message"=>"File Created successfully"]);
    }
    else{
        echo json_encode(["message"=>"File not created"]);
    }
}

else{
    echo json_encode(["message"=>"Incomplete Data"]);
}



?>