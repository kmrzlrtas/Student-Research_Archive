<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

$title = $_POST['title'];
$author = $_POST['author'];
$course = $_POST['course'];
$year = $_POST['year'];
$abstract = $_POST['abstract'];
$file = $_FILES['file'];

$upload_dir = "uploads/";
$target_file = $upload_dir . basename($file["name"]);

if (move_uploaded_file($file["tmp_name"], $target_file)) {
    $stmt = $conn->prepare("INSERT INTO researches (title, author, course, year, abstract, file_path) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $title, $author, $course, $year, $abstract, $target_file);
    $stmt->execute();
    echo "Research uploaded successfully! <a href='index.php'>Back to list</a>";
} else {
    echo "Failed to upload file.";
}
?>