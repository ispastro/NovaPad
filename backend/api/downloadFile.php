<?php
header("Access-Control-Allow-Origin: *"); // Or restrict to your frontend domain
header("Access-Control-Allow-Methods: POST, GET, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");



require_once '../config/database.php';
require_once '../core/FileManager.php';
require_once '../core/helpers.php';



if (!isset($_GET['filename'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Filename required']);
    exit;
}

$filename = sanitizeFileName($_GET['filename']);
$filePath = BASE_PATH . '/' . $filename;

if (!file_exists($filePath)) {
    http_response_code(404);
    echo json_encode(['status' => 'error', 'message' => 'File not found']);
    exit;
}

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));
flush();
readfile($filePath);
exit;

?>