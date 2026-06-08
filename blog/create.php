<?php
include 'db.php';

if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts(title, content) VALUES('$title','$content')";

    if(mysqli_query($conn, $sql))
    {
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Add New Post</h2>

<form method="POST">
    Title:<br>
    <input type="text" name="title" required><br><br>

    Content:<br>
    <textarea name="content" required></textarea><br><br>

    <input type="submit" name="submit" value="Save">
</form>

</body>
</html>