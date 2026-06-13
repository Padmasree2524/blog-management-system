<?php
include 'db.php';

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM posts WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];

    mysqli_query($conn, "UPDATE posts SET title='$title', content='$content' WHERE id=$id");

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>

<html>
<head>
    <title>Edit Post</title>

```
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:'Poppins',sans-serif;
    }

    body{
        min-height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        background:linear-gradient(135deg,#667eea,#764ba2,#6a11cb);
    }

    .container{
        width:500px;
        padding:35px;
        border-radius:20px;
        background:rgba(255,255,255,0.15);
        backdrop-filter:blur(15px);
        -webkit-backdrop-filter:blur(15px);
        box-shadow:0 8px 32px rgba(0,0,0,0.25);
    }

    h2{
        text-align:center;
        color:white;
        font-size:32px;
        margin-bottom:25px;
    }

    label{
        color:white;
        font-size:16px;
        font-weight:600;
        display:block;
        margin-bottom:8px;
    }

    input[type="text"],
    textarea{
        width:100%;
        padding:14px;
        border:none;
        border-radius:12px;
        outline:none;
        margin-bottom:20px;
        font-size:15px;
    }

    textarea{
        height:150px;
        resize:none;
    }

    .btn{
        width:100%;
        padding:14px;
        border:none;
        border-radius:12px;
        background:#00e676;
        color:white;
        font-size:16px;
        font-weight:600;
        cursor:pointer;
    }

    .btn:hover{
        background:#00c853;
    }

    .back{
        display:block;
        text-align:center;
        margin-top:15px;
        color:white;
        text-decoration:none;
        font-weight:600;
    }

</style>
```

</head>
<body>

<div class="container">

```
<h2>✏️ Edit Post</h2>

<form method="POST">

    <label>Title</label>

    <input
        type="text"
        name="title"
        value="<?php echo $row['title']; ?>"
        required
    >

    <label>Content</label>

    <textarea
        name="content"
        required
    ><?php echo $row['content']; ?></textarea>

    <input
        type="submit"
        name="update"
        value="Update Post"
        class="btn"
    >

</form>

<a href="index.php" class="back">← Back to Blog Posts</a>
```

</div>

</body>
</html>
