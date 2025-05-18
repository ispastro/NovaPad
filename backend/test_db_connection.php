<?php
require_once 'config/database.php';  // adjust the path if needed

$database = new Database();
$conn = $database->connect();

if ($conn) {
    echo '✅ Connected successfully to the database using PDO!';
} else {
    echo '❌ Failed to connect!';
}
?>
