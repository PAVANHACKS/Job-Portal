<?php
$conn = mysqli_connect("localhost", "root", "", "job_portal");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>