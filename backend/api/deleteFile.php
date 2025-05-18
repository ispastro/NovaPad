<?php
header("Access-Control-Allow-Origin: *"); // Or restrict to your frontend domain
header("Access-Control-Allow-Methods: POST, GET, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");


// Required files
require_once '../config/database.php';
require_once '../core/FileManager.php';
require_once '../core/helpers.php';
require_once '../models/File.php';

try {
    // Initialize database connection
    $database = new Database();
    $db = $database->connect();

    // Initialize managers
    $fileManager = new FileManager(BASE_PATH, VERSION_PATH);
    $file = new File($db);

    // Get input data
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['filename'])) {
        jsonResponse("error", "Filename is required.");
    }

    $filename = sanitizeFileName($data['filename']);
    $file->filename = $filename;

    // First delete from database
    if ($file->delete()) {
        // Then delete from filesystem
        if ($fileManager->delete($filename)) {
            jsonResponse("success", "File deleted successfully.");
        } else {
            jsonResponse("warning", "Deleted from DB, but failed to delete from the filesystem.");
        }
    } else {
        jsonResponse("error", "Failed to delete from the database.");
    }

} catch (Exception $e) {
    jsonResponse("error", "Server error: " . $e->getMessage());
}
?>
