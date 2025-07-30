<?php 
 include('auth.php'); 
include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Post</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <h2>Add New Post</h2>
    <form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Title" required><br><br>
    <textarea name="content" placeholder="Write your content..." required></textarea><br><br>
    <input type="file" name="image" accept="image/*"><br><br>
    <input type="submit" name="submit" value="Post">
</form>


<?php
if (isset($_POST['submit'])) {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $imageName = '';

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "uploads/";
        $imageName = time() . "_" . basename($_FILES['image']['name']);
        $targetPath = $targetDir . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
    }

    $stmt = $conn->prepare("INSERT INTO posts (title, content, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $content, $imageName);

    if ($stmt->execute()) {
        echo "<p>Post added successfully.</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
}
?>
</body>
</html>
