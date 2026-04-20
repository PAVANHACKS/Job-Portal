<link rel="stylesheet" href="../css/style.css">

<div class="container">
    <h2>Post Job</h2>
    <a href="applicants.php">View Applicants</a>

    <form action="add_job.php" method="POST">
        <input type="text" name="title" placeholder="Job Title">
        <input type="text" name="company" placeholder="Company">
        <input type="text" name="location" placeholder="Location">
        <input type="text" name="salary" placeholder="Salary">
        <textarea name="description"></textarea>

        <button>Post Job</button>
    </form>
</div>