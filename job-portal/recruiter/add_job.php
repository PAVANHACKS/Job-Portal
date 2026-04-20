<?php
include "../database/db.php";

$title = $_POST['title'];
$company = $_POST['company'];
$location = $_POST['location'];
$salary = $_POST['salary'];
$description = $_POST['description'];

mysqli_query($conn, "INSERT INTO jobs (title,company,location,salary,description)
VALUES ('$title','$company','$location','$salary','$description')");

header("Location: dashboard.php");
?>