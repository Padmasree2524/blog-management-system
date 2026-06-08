<?php
session_start();
include 'db.php';

if(isset($_POST['login']))
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row['password']))
        {
            $_SESSION['username'] = $row['username'];

            header("Location: index.php");
            exit();
        }
        else
        {
            $error = "⚠️ Invalid Username or Password!";
        }
    }
    else
    {
        $error = "⚠️ Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
overflow:hidden;
}

/* Floating Blobs */
.blob{
position:absolute;
border-radius:50%;
background:rgba(255,255,255,0.08);
filter:blur(60px);
animation:float 6s infinite alternate;
}

.blob:nth-child(1){
width:250px;
height:250px;
top:5%;
left:10%;
}

.blob:nth-child(2){
width:300px;
height:300px;
bottom:5%;
right:10%;
}

.blob:nth-child(3){
width:220px;
height:220px;
top:45%;
left:70%;
}

@keyframes float{
from{
transform:translateY(0px);
}
to{
transform:translateY(-40px);
}
}

/* Login Card */
.card{
width:420px;
padding:35px;
background:rgba(255,255,255,0.12);
backdrop-filter:blur(20px);
border-radius:24px;
border:1px solid rgba(255,255,255,0.2);
box-shadow:0 15px 40px rgba(0,0,0,0.25);
text-align:center;
animation:fadeIn .8s ease;
z-index:10;
}

@keyframes fadeIn{
from{
opacity:0;
transform:translateY(30px);
}
to{
opacity:1;
transform:translateY(0);
}
}

h2{
font-size:30px;
color:white;
margin-bottom:8px;
}

.subtitle{
color:rgba(255,255,255,0.85);
font-size:14px;
margin-bottom:25px;
line-height:1.6;
}

.error{
margin-bottom:15px;
color:#ffd4d4;
font-weight:600;
}

/* Inputs */
input[type=text],
input[type=password]{
width:100%;
padding:14px;
margin:10px 0;
border:none;
outline:none;
border-radius:14px;
background:rgba(255,255,255,0.15);
color:white;
font-size:15px;
transition:.3s;
}

input::placeholder{
color:rgba(255,255,255,0.75);
}

input:focus{
transform:scale(1.03);
background:rgba(255,255,255,0.22);
}

/* Button */
button{
width:100%;
padding:14px;
margin-top:12px;
border:none;
border-radius:14px;
font-size:16px;
font-weight:600;
cursor:pointer;
color:white;
background:linear-gradient(90deg,#00c6ff,#0072ff);
transition:.3s;
}

button:hover{
transform:scale(1.05);
box-shadow:0 0 20px rgba(255,255,255,0.3);
}

/* Footer */
.footer{
margin-top:20px;
color:white;
font-size:14px;
opacity:.85;
}

.footer a{
color:#fff;
font-weight:600;
text-decoration:none;
}

.footer a:hover{
text-decoration:underline;
}

</style>

</head>

<body>

<div class="blob"></div>
<div class="blob"></div>
<div class="blob"></div>

<div class="card">

<h2>👋 Welcome Back</h2>

<p class="subtitle">
Login to access your Blog Dashboard and manage your posts.
</p>

<?php
if(isset($error))
{
    echo "<div class='error'>$error</div>";
}
?>

<form method="POST">

<input type="text"
name="username"
placeholder="👤 Enter Username"
required>

<input type="password"
name="password"
placeholder="🔒 Enter Password"
required>

<button type="submit" name="login">
🚀 Login Now
</button>

</form>

<div class="footer">
Don't have an account?
<a href="register.php">Register</a>
</div>

</div>

</body>
</html>
