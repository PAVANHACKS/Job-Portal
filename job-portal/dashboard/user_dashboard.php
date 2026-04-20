<?php
session_start();
include "../database/db.php";

if(!isset($_SESSION['user'])){
    header("Location: ../login.html");
    exit();
}

$user = $_SESSION['user'];

// Fetch jobs
$result = mysqli_query($conn, "SELECT * FROM jobs");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Dashboard</title>

<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

/* HERO */
.hero {
    height: 100vh;
    background: linear-gradient(rgba(15,23,42,0.85), rgba(15,23,42,0.85)),
    url('https://s.tmimgcdn.com/scr/1200x750/69300/dream-job-job-portal-multipage-html5-website-template_69319-0-original.jpg') no-repeat center;
    background-size: cover;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
    text-align: center;
    position: relative;
}

.hero h1 { font-size: 50px; }
.hero p { margin-top: 10px; }

.hero-search {
    margin-top: 25px;
    display: flex;
    gap: 10px;
}

.hero-search input {
    padding: 14px;
    width: 220px;
    border-radius: 30px;
    border: none;
}

.hero-search button {
    padding: 14px 25px;
    border-radius: 30px;
    border: none;
    background: #facc15;
    cursor: pointer;
}

/* STATS */
.stats {
    position: absolute;
    bottom: 30px;
    display: flex;
    gap: 60px;
}

.stat-box {
    text-align: center;
}

.stat-box h2 { color: #facc15; }

/* PREPARATION */
.prep-container {
    display: flex;
    justify-content: center;
    gap: 25px;
    flex-wrap: wrap;
    padding: 30px;
}

.prep-card {
    width: 200px;
    padding: 25px;
    text-align: center;
    background: #1e293b;
    border-radius: 12px;
    cursor: pointer;
    transition: 0.3s;
    color: white;
}

.prep-card:hover {
    transform: translateY(-8px) scale(1.05);
    background: #334155;
}

.prep-content {
    max-width: 900px;
    margin: auto;
    padding: 20px;
}

.prep-content h3 {
    color: #facc15;
}

/* ===================== */
/* COMPANIES */
/* ===================== */
.alphabet-filter {
    text-align: center;
    margin-bottom: 20px;
}

.alphabet-filter span {
    margin: 4px;
    padding: 6px 10px;
    cursor: pointer;
    background: #1e293b;
    color: white;
    border-radius: 5px;
    transition: 0.3s;
}

.alphabet-filter span:hover {
    background: #facc15;
    color: black;
}

.company-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.company-card {
    background: #1e293b;
    padding: 20px;
    width: 220px;
    text-align: center;
    border-radius: 10px;
    transition: 0.3s;
    color: white;
}

.company-card:hover {
    transform: translateY(-5px);
}

.company-card a {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 15px;
    background: #22c55e;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

/* SECTIONS */
.section { display: none; }
.section.active { display: block; }

</style>

</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">JobPortal</div>

    <div class="nav-links">
        <a onclick="showSection('home')">Home</a>
        <a onclick="showSection('jobs')">Jobs</a>
        <a onclick="showSection('prep')">Preparation</a>
        <a onclick="showSection('companies')">Companies</a>
        <a onclick="showSection('dsa')">DSA</a>

        <button onclick="toggleMode()" class="mode-btn">🌙</button>

        <div class="profile">
            <img src="https://i.pravatar.cc/40" class="profile-img" onclick="toggleDropdown()">
            <div class="dropdown" id="dropdown">
                <a href="#">Profile</a>
                <a href="#">Settings</a>
                <a href="#">Education</a>
                <a href="#">Projects</a>
                <a href="#">Internships</a>
                <a href="../backend/logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- HOME -->
<div id="home" class="section active">
    <div class="hero">
        <h1>Find Your Dream Job 🚀</h1>
        <p>Search Jobs • Prepare Smart • Get Hired</p>

        <div class="hero-search">
            <input type="text" placeholder="Job Title">
            <input type="text" placeholder="Location">
            <button>Search</button>
        </div>

        <div class="stats">
            <div class="stat-box"><h2>1000+</h2><p>Jobs</p></div>
            <div class="stat-box"><h2>500+</h2><p>Companies</p></div>
            <div class="stat-box"><h2>Prep</h2><p>Ready</p></div>
            <div class="stat-box"><h2>DSA</h2><p>Practice</p></div>
        </div>
    </div>
</div>

<!-- JOBS -->
<div id="jobs" class="section">
<div class="job-container">
<?php while($row = mysqli_fetch_assoc($result)){ ?>
<div class="job-card">
    <h3><?php echo $row['title']; ?></h3>
    <p><?php echo $row['company']; ?></p>
    <p><?php echo $row['location']; ?></p>
    <button class="apply-btn">Apply Now</button>
</div>
<?php } ?>
</div>
</div>

<!-- PREPARATION (UNCHANGED) -->
<div id="prep" class="section">
<h2 style="text-align:center;margin:20px;">Preparation Hub 🚀</h2>
<div id="prep-main" class="prep-container">
    <div class="prep-card" onclick="showPrep('technical')">💻<h3>Technical</h3></div>
    <div class="prep-card" onclick="showPrep('aptitude')">📊<h3>Aptitude</h3></div>
    <div class="prep-card" onclick="showPrep('hr')">🧑‍💼<h3>HR</h3></div>
</div>
<div id="prep-sub" class="prep-container"></div>
<div id="prep-content" class="prep-content"></div>
</div>

<!-- ===================== -->
<!-- COMPANIES (NEW) -->
<!-- ===================== -->
<div id="companies" class="section">

<h2 style="text-align:center;margin:20px;">Top IT Companies 🌐</h2>

<div class="alphabet-filter">

</div>

<div class="company-container">

<div class="company-card" data-letter="A">
<h3>Accenture</h3>
<a href="https://www.accenture.com/in-en/careers" target="_blank">Apply</a>
</div>
<div class="company-card" data-letter="B">
<h3>Birla Soft</h3>
<a href="https://www.birlasoft.com/careers" target="_blank">Apply</a>
</div>



<div class="company-card" data-letter="C">
<h3>Cognizant</h3>
<a href="https://careers.cognizant.com" target="_blank">Apply</a>
</div>

<div class="company-card" data-letter="D">
<h3>Deloitte</h3>
<a href="https://jobs.deloitte.com" target="_blank">Apply</a>
</div>

<div class="company-card" data-letter="G">
<h3>Google</h3>
<a href="https://careers.google.com" target="_blank">Apply</a>
</div>

<div class="company-card" data-letter="A">
<h3>Hcl Tech</h3>
<a href="https://www.hcltech.com/careers" target="_blank">Apply</a>
</div>

<div class="company-card" data-letter="I">
<h3>Infosys</h3>
<a href="https://www.infosys.com/careers" target="_blank">Apply</a>
</div>

<div class="company-card" data-letter="M">
<h3>Microsoft</h3>
<a href="https://careers.microsoft.com" target="_blank">Apply</a>
</div>

<div class="company-card" data-letter="T">
<h3>TCS</h3>
<a href="https://www.tcs.com/careers" target="_blank">Apply</a>
</div>

<div class="company-card" data-letter="W">
<h3>Wipro</h3>
<a href="https://careers.wipro.com" target="_blank">Apply</a>
</div>

</div>
</div>

<div id="dsa" class="section">

<h2 style="text-align:center;margin:20px;">DSA Learning Hub 🚀</h2>

<!-- ROADMAP BUTTON -->
<button class="roadmap-btn" onclick="showRoadmap()">📚 Full DSA Roadmap</button>

<!-- TOPICS -->
<div class="dsa-topics">
    <div class="dsa-card" onclick="loadDSA('array')">Arrays</div>
    <div class="dsa-card" onclick="loadDSA('linkedlist')">Linked List</div>
    <div class="dsa-card" onclick="loadDSA('stack')">Stack</div>
    <div class="dsa-card" onclick="loadDSA('queue')">Queue</div>
    <div class="dsa-card" onclick="loadDSA('tree')">Trees</div>
    <div class="dsa-card" onclick="loadDSA('graph')">Graph</div>
</div>

<!-- FILTER -->
<div class="dsa-filter">
    <button onclick="filterDSA('all')">All</button>
    <button onclick="filterDSA('easy')">Easy</button>
    <button onclick="filterDSA('medium')">Medium</button>
    <button onclick="filterDSA('hard')">Hard</button>
</div>

<!-- CONTENT -->
<div id="dsa-content" class="dsa-content"></div>

</div>

<script>

function filterCompanies(letter){
    let cards = document.querySelectorAll(".company-card");
    cards.forEach(card=>{
        if(letter==="all" || card.dataset.letter===letter){
            card.style.display="block";
        } else {
            card.style.display="none";
        }
    });
}

function toggleDropdown(){
    let d=document.getElementById("dropdown");
    d.style.display=d.style.display==="block"?"none":"block";
}

function toggleMode(){
    document.body.classList.toggle("dark-mode");
}

function showSection(id){
    document.querySelectorAll('.section').forEach(s=>s.classList.remove('active'));
    document.getElementById(id).classList.add('active');
}

</script>

</body>
</html>