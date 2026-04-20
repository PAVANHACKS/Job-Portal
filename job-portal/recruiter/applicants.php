<?php
include "../database/db.php";

$query = "SELECT applications.*, users.name, jobs.title 
FROM applications
JOIN users ON applications.user_id = users.id
JOIN jobs ON applications.job_id = jobs.id";

$result = mysqli_query($conn, $query);
?>

<link rel="stylesheet" href="../css/style.css">

<div class="container">
<h2>Applicants</h2>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<div class="form-box">
    <h3><?php echo $row['name']; ?></h3>
    <p>Job: <?php echo $row['title']; ?></p>

    <a href="../uploads/<?php echo $row['resume']; ?>" target="_blank">
        View Resume
    </a>
</div>
<?php } ?>

</div>