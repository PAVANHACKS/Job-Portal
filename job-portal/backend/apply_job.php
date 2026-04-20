<?php
session_start();
include "../database/db.php";

$user_id = $_SESSION['user']['id'];
$job_id = $_POST['job_id'];

$filename = $_FILES['resume']['name'];
$tempname = $_FILES['resume']['tmp_name'];

$folder = "../uploads/" . $filename;

$check = mysqli_query($conn,"SELECT * FROM applications 
WHERE user_id='$user_id' AND job_id='$job_id'");

if(mysqli_num_rows($check) > 0){
    die("Already Applied!");
}

// Move file
move_uploaded_file($tempname, $folder);

// Save in DB
$sql = "INSERT INTO applications (user_id, job_id, resume)
VALUES ('$user_id','$job_id','$filename')";
$user_email = $_SESSION['user']['email'];

$to = $user_email;
$subject = "Job Application Confirmation";
$message = "You have successfully applied for the job.";
$headers = "From: no-reply@jobportal.com";

mail($to,$subject,$message,$headers);

if(mysqli_query($conn,$sql)){
    echo "Applied Successfully!";
} else {
    echo "Error";
}
?>