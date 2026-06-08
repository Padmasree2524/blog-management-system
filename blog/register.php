<?php

$conn = mysqli_connect("localhost", "root", "", "blog");

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($password)) {

        $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

        if (mysqli_num_rows($check) > 0) {

            $msg = "⚠️ Username already exists!";

        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users(username,password)
                    VALUES('$username','$hashedPassword')";

            if (mysqli_query($conn, $sql)) {

                header("Location: login.php");
                exit();

            } else {

                $msg = "❌ Database Error!";
            }
        }

    } else {

        $msg = "⚠️ Please fill all fields!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Join BlogSphere</title>

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
background:linear-gradient(135deg,#4f46e5,#9333ea,#06b6d4);
overflow:hidden;
}

/* Background Blobs */
.blob{
position:absolute;
border-radius:50%;
background:rgba(255,255,255,0.12);
filter:blur(70px);
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
transform:translateY(0);
}
to{
transform:translateY(-40px);
}
}

/* Card */
.card{
width:450px;
padding:40px;
background:rgba(255,255,255,0.12);
backdrop-filter:blur(20px);
border-radius:25px;
border:1px solid rgba(255,255,255,0.2);
box-shadow:0 20px 40px rgba(0,0,0,0.25);
text-align:center;
animation:fadeIn 1s ease, floatCard 4s ease-in-out infinite;
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

@keyframes floatCard{
0%,100%{
transform:translateY(0);
}
50%{
transform:translateY(-8px);
}
}

h2{
font-size:34px;
margin-bottom:10px;
background:linear-gradient(90deg,#ffffff,#dbeafe,#ffffff);
background-size:200% auto;
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
animation:shine 3s linear infinite;
}

@keyframes shine{
to{
background-position:200% center;
}
}

.subtitle{
color:rgba(255,255,255,.9);
font-size:14px;
margin-bottom:25px;
line-height:1.7;
}

.msg{
margin-bottom:15px;
font-weight:600;
color:white;
}

input{
width:100%;
padding:15px;
margin:10px 0;
border:none;
outline:none;
border-radius:15px;
background:rgba(255,255,255,.15);
color:white;
font-size:15px;
transition:.3s;
}

input::placeholder{
color:rgba(255,255,255,.75);
}

input:focus{
transform:scale(1.03);
background:rgba(255,255,255,.22);
}

button{
width:100%;
padding:15px;
margin-top:15px;
border:none;
border-radius:15px;
font-size:16px;
font-weight:700;
cursor:pointer;
color:white;
background:linear-gradient(90deg,#06b6d4,#8b5cf6,#ec4899);
background-size:200% auto;
transition:.4s;
}

button:hover{
background-position:right center;
transform:scale(1.05);
box-shadow:0 0 25px rgba(255,255,255,.35);
}

.footer{
margin-top:22px;
color:white;
font-size:14px;
}

.footer a{
color:white;
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

<h2>🚀 Join BlogSphere</h2>

<p class="subtitle">
Create your account and start publishing amazing blog posts today.
</p>

<?php if($msg!=""){ ?>
<p class="msg"><?php echo $msg; ?></p>
<?php } ?>

<form method="POST">

<input type="text"
name="username"
placeholder="👤 Choose Username"
required>

<input type="password"
name="password"
placeholder="🔒 Create Password"
required>

<button type="submit">
✨ Create Account
</button>

</form>

<div class="footer">
Already a member?
<a href="login.php">Sign In</a>
</div>

</div>

</body>
</html>