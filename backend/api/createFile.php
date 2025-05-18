<?php
header("Access-Control-Allow-Origin: *"); // Or restrict to your frontend domain
header("Access-Control-Allow-Methods: POST, GET, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Include database and model
include_once("../config/database.php");
include_once("../models/File.php");

// Connect to DB
$database = new Database();
$db = $database->connect();

// Create File instance
$file = new File($db);

// Decode input data (fixing input stream)
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->filename) && isset($data->content)) {
    $file->filename = htmlspecialchars(strip_tags($data->filename));
    $file->content = $data->content;

    if ($file->create()) {
        echo json_encode(["message" => "File created successfully"]);
    } else {
        echo json_encode(["message" => "Something went wrong while creating the file"]);
    }
} else {
    echo json_encode(["message" => "Incomplete data"]);
}
?>
