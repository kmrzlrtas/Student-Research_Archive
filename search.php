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
You sent
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

$q = $conn->real_escape_string($_GET['q']);
$result = $conn->query("SELECT * FROM researches WHERE 
    title LIKE '%$q%' OR 
    author LIKE '%$q%' OR 
    course LIKE '%$q%' OR 
    year LIKE '%$q%'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Search Results for "<?= htmlspecialchars($q) ?>"</h1>
    <a href="index.php">← Back to Archive</a>
    <hr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='research'>";
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
            echo "<p><strong>Author:</strong> " . htmlspecialchars($row['author']) . "</p>";
            echo "<p><strong>Course:</strong> " . htmlspecialchars($row['course']) . "</p>";
            echo "<p><strong>Year:</strong> " . $row['year'] . "</p>";
            echo "<p><strong>Abstract:</strong><br>" . nl2br(htmlspecialchars($row['abstract'])) . "</p>";
            echo "<a href='" . $row['file_path'] . "' target='_blank'>Download PDF</a>";
            echo "</div><hr>";
        }
    } else {
        echo "<p>No results found.</p>";
    }
    ?>
</body>
</html>