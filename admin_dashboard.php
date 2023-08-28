<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or show a message
    header("Location: login.php");
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        ADMIN is HERE
    </h1>


    <li class="menu-item">
    <a href="backend/logout.php" class="menu-link">
        <i class="fas fa-sign-out-alt menu-icon"></i>
        Logout
    </a>
</li>
</body>
</html>