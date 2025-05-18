<?php

header("Access-Control-Allow-Origin: *"); // Or restrict to your frontend domain
header("Access-Control-Allow-Methods: POST, GET, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");


require_once '../config/config.php';
require_once '../core/helpers.php';
require_once '../core/fileManager.php';



// Instantiate FileManager
$fileManager = new FileManager(BASE_PATH, VERSION_PATH);

// Fetch file list
try {
    $files = $fileManager->listFiles();

    if (empty($files)) {
        jsonResponse('success', 'No files found.', []);
    }

    jsonResponse('success', 'Files listed successfully.', $files);

} catch (Exception $e) {
    jsonResponse('error', 'Failed to retrieve file list: ' . $e->getMessage());
}
