<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Post</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>Add New Post</h2>
    <form action="" method="post">
        <input type="text" name="title" placeholder="Title" required><br><br>
        <textarea name="content" placeholder="Write your content..." required></textarea><br><br>
        <input type="submit" name="submit" value="Post">
    </form>

<?php
if (isset($_POST['submit'])) {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);

    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        echo "<p>Post added successfully.</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
}
?>
</body>
</html>
