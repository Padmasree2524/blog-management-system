<?php
session_start();

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

include 'db.php';

$result = mysqli_query($conn, "SELECT * FROM posts");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog Posts</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<a href="logout.php" style="
position:absolute;
top:20px;
right:20px;
background:red;
color:white;
padding:10px 15px;
border-radius:8px;
text-decoration:none;
font-weight:bold;
">
Logout
</a>

<h2>Welcome, <?php echo $_SESSION['username']; ?> 👋</h2>

<a href="create.php">➕ Add New Post</a>

<br><br>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Content</th>
        <th>Action</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['content']; ?></td>
        <td>
            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
            |
            <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>