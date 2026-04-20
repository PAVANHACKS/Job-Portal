


<?php
session_start();

include "../database/db.php";
if(!isset($_SESSION['user'])){
    header("Location: ../login.html");
}

$uid = $_SESSION['user']['id'];

$query = "SELECT jobs.* FROM applications
JOIN jobs ON jobs.id = applications.job_id
WHERE applications.user_id='$uid'";

$result = mysqli_query($conn,$query);
?>

<link rel="stylesheet" href="../css/style.css">

<div class="navbar">
    <h2>JobPortal</h2>
    <div>
        <a href="user_dashboard.php">Home</a>
        <a href="saved_jobs.php">Saved</a>
        <a href="applied_jobs.php">Applied Jobs</a>
        <a href="../backend/logout.php">Logout</a>
    </div>
</div>

<div class="job-container">
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<div class="job-card">
    <h3><?php echo $row['title']; ?></h3>
    <p><?php echo $row['company']; ?></p>
    <p style="color:green;">Applied ✅</p>
</div>
<?php } ?>
</div>