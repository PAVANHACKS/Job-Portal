<?php
session_start();
include "../database/db.php";

$result = mysqli_query($conn,"SELECT * FROM users");
?>

<link rel="stylesheet" href="../css/admin.css">

<div class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="manage_users.php">Users</a>
    <a href="manage_jobs.php">Jobs</a>
</div>

<div class="content">
<h2>Manage Users</h2>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<div class="card">
    <p><?php echo $row['name']; ?></p>
    <p><?php echo $row['role']; ?></p>

    <a href="delete_user.php?id=<?php echo $row['id']; ?>" 
       onclick="return confirm('Delete this user?')">
       Delete
    </a>
</div>
<?php } ?>

</div>