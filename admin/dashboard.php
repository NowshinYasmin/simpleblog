<?php include('../auth.php'); include('../config.php'); ?>
<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title></head>
<body>
    <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>
    <a href="logout.php">Logout</a> |
    <a href="../add_post.php">➕ Add Post</a><br><br>

    <h3>All Posts</h3>
    <?php
    $result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<b>" . $row['title'] . "</b><br>";
        echo "<a href='../edit_post.php?id=" . $row['id'] . "'>Edit</a> | ";
        echo "<a href='../delete_post.php?id=" . $row['id'] . "' onclick='return confirm(\"Delete?\")'>Delete</a>";
        echo "</div><hr>";
    }
    ?>
</body>
</html>
