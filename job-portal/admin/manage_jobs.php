<?php
session_start();
include "../database/db.php";

$result = mysqli_query($conn,"SELECT * FROM jobs");
?>

<link rel="stylesheet" href="../css/admin.css">

<div class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="manage_users.php">Users</a>
    <a href="manage_jobs.php">Jobs</a>
</div>

<div class="content">
<h2>Manage Jobs</h2>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<div class="card">
    <p><?php echo $row['title']; ?></p>
    <p><?php echo $row['company']; ?></p>

    <a href="delete_job.php?id=<?php echo $row['id']; ?>" 
       onclick="return confirm('Delete this job?')">
       Delete
    </a>
</div>
<?php } ?>

</div>