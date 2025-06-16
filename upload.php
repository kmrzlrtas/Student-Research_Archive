<!DOCTYPE html>
<html>
<head>
    <title>Upload Research</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Upload Student Research</h1>
    <form action="insert.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required><br>
        <input type="text" name="author" placeholder="Author" required><br>
        <input type="text" name="course" placeholder="Course" required><br>
        <input type="number" name="year" placeholder="Year" required><br>
        <textarea name="abstract" placeholder="Abstract" required></textarea><br>
        <input type="file" name="file" accept=".pdf" required><br>
        <button type="submit">Upload</button>
    </form>
    <a href="index.php">Back to List</a>
</body>
</html>