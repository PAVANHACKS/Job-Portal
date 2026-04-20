<?php
include "../database/db.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if($password !== $confirm){
        echo "Passwords do not match";
        exit();
    }

    // check existing email
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($check) > 0){
        echo "Email already registered";
        exit();
    }

    // hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // default role
    $role = "user";

    $sql = "INSERT INTO users (name, email, password, role)
            VALUES ('$name', '$email', '$hashed_password', '$role')";

    if(mysqli_query($conn, $sql)){
        header("Location: http://localhost/job-portal/login.html");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

print_r($_POST);
exit();


?>