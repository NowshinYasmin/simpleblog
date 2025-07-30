<?php
 include('auth.php'); 

include('config.php');

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM posts WHERE id = $id");
$row = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);

    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $id);
    
    if ($stmt->execute()) {
        echo "<p>Post updated! <a href='index.php'>Go back</a></p>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>Edit Post</h2>
    <form method="post">
        <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required><br><br>
        <textarea name="content" required><?php echo htmlspecialchars($row['content']); ?></textarea><br><br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
