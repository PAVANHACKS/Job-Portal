<?php
session_start();
include "../database/db.php";

/* 🔐 Role Protection */
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    header("Location: ../login.html");
    exit();
}

/* 👥 Count Users */
$user_query = mysqli_query($conn, "SELECT COUNT(*) as total_users FROM users");
$user_data = mysqli_fetch_assoc($user_query);
$user_count = $user_data['total_users'];

/* 💼 Count Jobs */
$job_query = mysqli_query($conn, "SELECT COUNT(*) as total_jobs FROM jobs");
$job_data = mysqli_fetch_assoc($job_query);
$job_count = $job_data['total_jobs'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="../css/admin.css">
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h3>Admin Panel</h3>
    <a href="dashboard.php">Dashboard</a>
    <a href="manage_users.php">Users</a>
    <a href="manage_jobs.php">Jobs</a>
    <a href="../backend/logout.php">Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="content">
    <h2>Dashboard</h2>

    <div class="card">
        <h3>Users</h3>
        <p><?php echo $user_count; ?></p>
    </div>

    <div class="card">
        <h3>Jobs</h3>
        <p><?php echo $job_count; ?></p>
    </div>
</div>

</body>
</html>