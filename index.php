<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Research Archive</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Student Research Archive</h1>

    <form action="search.php" method="GET">
        <input type="text" name="q" placeholder="Search by title, author, course, or year" required>
        <button type="submit">Search</button>
    </form>

    <a href="upload.php">Upload New Research</a>
    <hr>

    <?php
    $result = $conn->query("SELECT * FROM researches ORDER BY year DESC");
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
        echo "<p>No research uploaded yet.</p>";
    }
    ?>
</body>
</html>