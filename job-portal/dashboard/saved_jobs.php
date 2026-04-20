<?php
session_start();
include "../database/db.php";
if(!isset($_SESSION['user'])){
    header("Location: ../login.html");
}

$uid = $_SESSION['user']['id'];

$query = "SELECT jobs.* FROM saved_jobs 
JOIN jobs ON jobs.id = saved_jobs.job_id
WHERE saved_jobs.user_id='$uid'";

$result = mysqli_query($conn,$query);
?>

<link rel="stylesheet" href="../css/style.css">

<h2>Saved Jobs ❤️</h2>

<div class="job-container">
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<div class="job-card">
    <h3><?php echo $row['title']; ?></h3>
    <p><?php echo $row['company']; ?></p>
</div>
<?php } ?>
</div>