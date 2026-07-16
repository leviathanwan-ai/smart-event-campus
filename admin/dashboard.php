<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

// Statistik
$total_event = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM event"));
$total_seminar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM event WHERE kategori='Seminar'"));
$total_workshop = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM event WHERE kategori='Workshop'"));
$total_lomba = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM event WHERE kategori='Lomba'"));
$total_pelatihan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM event WHERE kategori='Pelatihan'"));

// Event terbaru
$event_terbaru = mysqli_query($conn, "SELECT * FROM event ORDER BY tanggal DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Admin

</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
    background:linear-gradient(135deg,#0d6efd,#4f8cff,#74b9ff);
    background-size:400% 400%;
    animation:gradientMove 12s ease infinite;
    min-height:100vh;
    overflow-x:hidden;
    position:relative;
}
.card{
    border:none;
    border-radius:15px;
}

.stat-card{
    transition:all .35s ease;
    cursor:pointer;
    border-radius:18px;
    overflow:hidden;
}

.stat-card:hover{
    transform:translateY(-10px) scale(1.03);
    box-shadow:0 20px 35px rgba(0,0,0,.25);
}
.stat-card i{
    transition:all .35s ease;
}

.stat-card:hover i{
    transform:rotate(-10deg) scale(1.2);
}
.btn{
    transition:all .3s ease;
}

.btn:hover{
    transform:scale(1.05);
}
.list-group-item{
    transition:all .3s ease;
}

.list-group-item:hover{
    transform:translateX(8px);
    background:#eef5ff;
}
.bg-circle{
    position:fixed;
    border-radius:50%;
    filter:blur(10px);
    opacity:.35;
    z-index:-1;
    animation:float 8s ease-in-out infinite;
}

.circle1{
    width:250px;
    height:250px;
    background:#ffffff;
    top:-60px;
    left:-70px;
}

.circle2{
    width:180px;
    height:180px;
    background:#87cefa;
    right:60px;
    top:120px;
    animation-delay:2s;
}

.circle3{
    width:320px;
    height:320px;
    background:#ffffff;
    bottom:-100px;
    left:40%;
    animation-delay:4s;
}

@keyframes float{

0%{
transform:translateY(0px);
}

50%{
transform:translateY(-25px);
}

100%{
transform:translateY(0px);
}

}
@keyframes gradientMove{

0%{
background-position:0% 50%;
}

50%{
background-position:100% 50%;
}

100%{
background-position:0% 50%;
}

}

.bg-campus{
position:fixed;
bottom:0;
left:0;
width:100%;
height:240px;
background:url('https://www.transparenttextures.com/patterns/cubes.png');
opacity:.12;
z-index:-3;
}

.cloud{

position:fixed;

background:white;

opacity:.18;

border-radius:100px;

animation:cloudMove linear infinite;

z-index:-2;

}

.cloud::before{

content:"";

position:absolute;

width:70px;

height:70px;

background:white;

border-radius:50%;

top:-30px;

left:20px;

}

.cloud::after{

content:"";

position:absolute;

width:90px;

height:90px;

background:white;

border-radius:50%;

top:-45px;

right:20px;

}

.cloud1{

width:220px;

height:70px;

top:80px;

left:-250px;

animation-duration:28s;

}

.cloud2{

width:170px;

height:60px;

top:180px;

left:-200px;

animation-duration:40s;

animation-delay:8s;

}

.cloud3{

width:250px;

height:80px;

top:40px;

left:-280px;

animation-duration:50s;

animation-delay:15s;

}

@keyframes cloudMove{

from{

transform:translateX(0);

}

to{

transform:translateX(1800px);

}

}

.floating-icon{

position:fixed;

font-size:38px;

opacity:.18;

color:white;

animation:floatIcon 8s ease-in-out infinite;

z-index:-1;

}

.icon1{

top:18%;

left:8%;

}

.icon2{

top:30%;

right:12%;

animation-delay:2s;

}

.icon3{

bottom:22%;

left:25%;

animation-delay:4s;

}

.icon4{

bottom:12%;

right:20%;

animation-delay:6s;

}

@keyframes floatIcon{

0%{

transform:translateY(0) rotate(0deg);

}

50%{

transform:translateY(-20px) rotate(10deg);

}

100%{

transform:translateY(0) rotate(0deg);

}

}


.card{
    backdrop-filter:blur(12px);
    background:rgba(255,255,255,.95);
    transition:.4s;
}

.card:hover{
    box-shadow:0 20px 40px rgba(0,0,0,.2);
}

</style>

</head>

<body>

<div class="bg-campus"></div>

<div class="cloud cloud1"></div>

<div class="cloud cloud2"></div>

<div class="cloud cloud3"></div>

<i class="bi bi-mortarboard-fill floating-icon icon1"></i>

<i class="bi bi-book-fill floating-icon icon2"></i>

<i class="bi bi-laptop floating-icon icon3"></i>

<i class="bi bi-calendar-event floating-icon icon4"></i>

<div class="bg-circle circle1"></div>

<div class="bg-circle circle2"></div>

<div class="bg-circle circle3"></div>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-lg">

<div class="container">

<a class="navbar-brand fw-bold">

<i class="bi bi-mortarboard-fill"></i>

Smart Event Campus

</a>

<a href="logout.php" class="btn btn-light">

<i class="bi bi-box-arrow-right"></i>

Logout

</a>

</div>

</nav>

<div class="container mt-5">

<?php
date_default_timezone_set("Asia/Jakarta");

$jam = date("H");

if($jam >= 5 && $jam < 11){
    $salam = "🌅 Selamat Pagi";
}elseif($jam >= 11 && $jam < 15){
    $salam = "☀ Selamat Siang";
}elseif($jam >= 15 && $jam < 18){
    $salam = "🌇 Selamat Sore";
}else{
    $salam = "🌙 Selamat Malam";
}
?>

<div class="mb-4">

<h2 class="fw-bold text-white">
Dashboard Admin
</h2>

<h5 class="text-white">
<?= $salam; ?>, Admin 👋
</h5>

<p class="text-white mb-1">
📅 <span id="tanggal"></span>
</p>

<p class="text-white">
🕒 <span id="jam"></span>
</p>

</div>

<div class="row">

<div class="col-md-3 mb-4">

<a href="event.php" style="text-decoration:none;color:inherit;">

<div class="card stat-card bg-primary text-white shadow">

<div class="card-body text-center">

<i class="bi bi-calendar-event display-5"></i>

<h5 class="mt-3">

Total Event

</h5>

<h2>

<?= $total_event['total']; ?>

</h2>

</div>

</div>

</a>

</div>

<div class="col-md-3 mb-4">

<a href="event.php?kategori=Seminar" style="text-decoration:none;color:inherit;">

<div class="card stat-card bg-success text-white shadow">

<div class="card-body text-center">

<i class="bi bi-mic-fill display-5"></i>

<h5 class="mt-3">

Seminar

</h5>

<h2>

<?= $total_seminar['total']; ?>

</h2>

</div>

</div>

</a>

</div>

<div class="col-md-3 mb-4">

<a href="event.php?kategori=Workshop" style="text-decoration:none;color:inherit;">

<div class="card stat-card bg-warning text-dark shadow">

<div class="card-body text-center">

<i class="bi bi-laptop display-5"></i>

<h5 class="mt-3">

Workshop

</h5>

<h2>

<?= $total_workshop['total']; ?>

</h2>

</div>

</div>

</a>

</div>

<div class="col-md-3 mb-4">

<a href="event.php?kategori=Lomba" style="text-decoration:none;color:inherit;">

<div class="card stat-card bg-danger text-white shadow">

<div class="card-body text-center">

<i class="bi bi-trophy-fill display-5"></i>

<h5 class="mt-3">

Lomba

</h5>

<h2>

<?= $total_lomba['total']; ?>

</h2>

</div>

</div>

</a>

</div>

<div class="col-md-3 mb-4">

<a href="event.php?kategori=Pelatihan" style="text-decoration:none;color:inherit;">

<div class="card stat-card bg-dark text-white shadow">

<div class="card-body text-center">

<i class="bi bi-book-fill display-5"></i>

<h5 class="mt-3">

Pelatihan

</h5>

<h2>

<?= $total_pelatihan['total']; ?>

</h2>

</div>

</div>

</a>

</div>

<div class="col-md-9">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">

Selamat Datang Admin 👋

</h5>

</div>

<div class="card-body">

<p>

Kelola seluruh kegiatan kampus seperti Seminar, Workshop,
Lomba, dan Pelatihan Mahasiswa melalui dashboard ini.

</p>

<a href="event.php" class="btn btn-success">

<i class="bi bi-table"></i>

Kelola Data Event

</a>

<hr>

<h5 class="mt-4">

📅 Event Terbaru

</h5>

<div class="list-group">
    <?php
while($row = mysqli_fetch_assoc($event_terbaru)){
?>

<a href="event.php" class="list-group-item list-group-item-action">

<div class="d-flex w-100 justify-content-between">

<h6 class="mb-1">

<?= $row['nama_event']; ?>

</h6>

<small>

<?= date('d M Y', strtotime($row['tanggal'])); ?>

</small>

</div>

<p class="mb-1">

📍 <?= $row['lokasi']; ?>

</p>

<span class="badge bg-primary">

<?= $row['kategori']; ?>

</span>

</a>

<?php
}
?>

</div>

</div>

</div>

</div>

</div>

<footer class="mt-5 bg-white border-top shadow-sm">

<div class="container py-4 text-center">

<h5 class="fw-bold">
🎓 Smart Event Campus
</h5>

<p class="text-muted mb-1">
Sistem Informasi Kegiatan Mahasiswa
</p>

<p class="text-muted mb-0">
© 2026 Smart Event Campus
</p>

</div>

</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

function updateClock(){

const now = new Date();

document.getElementById("jam").innerHTML =
now.toLocaleTimeString('id-ID');

document.getElementById("tanggal").innerHTML =
now.toLocaleDateString('id-ID',{
weekday:'long',
day:'numeric',
month:'long',
year:'numeric'
});

}

updateClock();

setInterval(updateClock,1000);

</script>

</body>

</html>