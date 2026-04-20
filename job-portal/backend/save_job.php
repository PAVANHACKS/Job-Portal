<?php
session_start();
include "../database/db.php";

$user_id = $_SESSION['user']['id'];
$job_id = $_POST['job_id'];

mysqli_query($conn,"INSERT INTO saved_jobs(user_id,job_id)
VALUES('$user_id','$job_id')");

header("Location: ../dashboard/user_dashboard.php");
?>