<?php
session_start();
session_destroy();
header("Location: ../login.html");
?>

<a href="../backend/logout.php">Logout</a>