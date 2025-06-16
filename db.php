<?php
// Enable full error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "research_archive");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>