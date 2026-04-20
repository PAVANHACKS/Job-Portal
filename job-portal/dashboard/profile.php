<?php
session_start();
include "../database/db.php";

if(!isset($_SESSION['user'])){
    header("Location: ../login.html");
}

$user = $_SESSION['user'];
?>

<link rel="stylesheet" href="../css/style.css">

<div class="form-box">
<h2>Profile</h2>

<form action="../backend/update_profile.php" method="POST">
<input type="text" name="name" value="<?php echo $user['name']; ?>">
<input type="password" name="password" placeholder="New Password">

<button>Update</button>
</form>
</div>