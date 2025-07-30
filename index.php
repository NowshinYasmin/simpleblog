<?php
 

 include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>
<div class="header">
    <h1>SimpleBlog</h1>
    <div class="lang-switch">
        <a href="?lang=en">🇬🇧 English</a> | 
        <a href="?lang=bn">🇧🇩 বাংলা</a>
    </div>
</div>

<body>
<div class="container">
  <div class="content">
    <h2>All Blog Posts</h2>
    <a href="add_post.php">➕ Add New Post</a><br><br>

	<form method="get" action="index.php">
    <input type="text" name="q" placeholder="Search blog..." value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>" required>
    <input type="submit" value="Search">
</form>
<br>

	<?php
if (isset($_GET['q'])) {
    echo "<h4>Showing results for: <em>" . htmlspecialchars($_GET['q']) . "</em></h4>";
}
?>


    <?php
if (isset($_GET['q'])) {
    $search = $conn->real_escape_string($_GET['q']);
    $query = "SELECT * FROM posts WHERE title LIKE '%$search%' OR content LIKE '%$search%' ORDER BY created_at DESC";
} else {
    $query = "SELECT * FROM posts ORDER BY created_at DESC";
}

$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    echo "<div class='post'>";
    echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
    
    if (!empty($row['image'])) {
        echo "<img src='uploads/" . $row['image'] . "' width='100%' style='max-width:400px;'><br><br>";
    }

    echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
    echo "<small>Posted on " . $row['created_at'] . "</small><br><br>";
    echo "<a href='edit_post.php?id=" . $row['id'] . "'>✏️ Edit</a> | ";
    echo "<a href='delete_post.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this post?\")'>🗑️ Delete</a>";
    echo "</div><hr>";
}
?>
</div>
<div class="sidebar">
    <h3>📚 About</h3>
    <p>Welcome to SimpleBlog! A PHP-based blog where you can write and read posts.</p>

    <h3>🗂️ Categories</h3>
    <ul>
      <li><a href="#">Technology</a></li>
      <li><a href="#">Lifestyle</a></li>
      <li><a href="#">Travel</a></li>
    </ul>

    <h3>📅 Archive</h3>
    <ul>
      <li><a href="#">July 2025</a></li>
      <li><a href="#">June 2025</a></li>
    </ul>
  </div>
</div>
</div>
</body>
<footer>
    <p>&copy; <?php echo date('Y'); ?> SimpleBlog. All rights reserved.</p>
</footer>

</html>
