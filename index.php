<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>All Blog Posts</h2>
    <a href="add_post.php">➕ Add New Post</a><br><br>
    <?php
    $result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
    while ($row = $result->fetch_assoc()) {
        echo "<div class='post'>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
        echo "<small>Posted on " . $row['created_at'] . "</small>";
        echo "</div><hr>";
    }
    ?>
</body>
</html>
