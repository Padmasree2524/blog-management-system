<?php
session_start();

// session ni clear chestundi
session_unset();
session_destroy();

// login page ki redirect chestundi
header("Location: login.php");
exit();
?>