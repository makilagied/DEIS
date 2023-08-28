<?php
session_start();
session_destroy();

// Redirect to login page or any other appropriate page
header("Location: ../login.php");
exit();
?>
