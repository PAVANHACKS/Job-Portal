<?php
session_start();
include "../database/db.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password'])){

            $_SESSION['user'] = $user;

            if($user['role'] == "admin"){
                header("Location: http://localhost/job-portal/admin/dashboard.php");
                exit();
            } 
            else if($user['role'] == "recruiter"){
                header("Location: http://localhost/job-portal/recruiter/dashboard.php");
                exit();
            } 
            else {
                header("Location: http://localhost/job-portal/dashboard/user_dashboard.php");
                exit();
            }

        } else {
            echo "Wrong Password";
        }
    } else {
        echo "User not found";
    }

} else {
    echo "Invalid Request";
}
?>