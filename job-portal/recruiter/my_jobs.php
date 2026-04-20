<?php
session_start();
include "../database/db.php";

$result = mysqli_query($conn,"SELECT * FROM jobs");
?>

<h2>My Jobs</h2>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<div class="form-box">
    <p><?php echo $row['title']; ?></p>
    <a href="delete_job.php?id=<?php echo $row['id']; ?>">Delete</a>
</div>
<?php } ?>