<?php
session_start();
include "../database/db.php";

$id = $_SESSION['user']['id'];
$name = $_POST['name'];

if($_POST['password'] != ""){
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    mysqli_query($conn,"UPDATE users SET name='$name', password='$pass' WHERE id='$id'");
} else {
    mysqli_query($conn,"UPDATE users SET name='$name' WHERE id='$id'");
}

header("Location: ../dashboard/user_dashboard.php");
?>