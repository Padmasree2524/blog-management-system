<?php
session_start();

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

include 'db.php';


// SEARCH
$search = "";

if(isset($_GET['search']))
{
    $search = $_GET['search'];
}


// PAGINATION

$limit = 5;

if(isset($_GET['page']))
{
    $page = $_GET['page'];
}
else
{
    $page = 1;
}

$start = ($page - 1) * $limit;


// GET POSTS

$sql = "SELECT * FROM posts 
WHERE title LIKE '%$search%' 
OR content LIKE '%$search%'
LIMIT $start,$limit";


$result = mysqli_query($conn,$sql);


// COUNT POSTS

$count_sql = "SELECT COUNT(*) AS total 
FROM posts
WHERE title LIKE '%$search%'
OR content LIKE '%$search%'";


$count_result = mysqli_query($conn,$count_sql);

$count_row = mysqli_fetch_assoc($count_result);

$total_posts = $count_row['total'];

$total_pages = ceil($total_posts/$limit);

?>


<!DOCTYPE html>
<html>

<head>

<title>Blog Posts</title>

<link rel="stylesheet" href="style.css">

</head>


<body>


<a href="logout.php" class="logout">
Logout
</a>



<h2>
Welcome, <?php echo $_SESSION['username']; ?> 👋
</h2>



<a href="create.php" class="add-btn">
➕ Add New Post
</a>




<div class="search-box">

<form method="GET">

<input 
type="text"
name="search"
placeholder="Search posts..."
value="<?php echo $search; ?>"
>


<button>
🔍 Search
</button>


</form>

</div>




<div class="cards">


<?php while($row=mysqli_fetch_assoc($result)){ ?>


<div class="blog-card">


<h3>
<?php echo $row['title']; ?>
</h3>


<p>
<?php echo $row['content']; ?>
</p>



<div class="actions">


<a href="edit.php?id=<?php echo $row['id']; ?>">
✏ Edit
</a>


<a href="delete.php?id=<?php echo $row['id']; ?>">
🗑 Delete
</a>


</div>


</div>



<?php } ?>


</div>






<div class="pagination">


<?php

for($i=1;$i<=$total_pages;$i++)
{

?>


<a href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>">

<?php echo $i; ?>

</a>


<?php

}

?>


</div>




</body>

</html>