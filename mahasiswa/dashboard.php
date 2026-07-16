<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['mahasiswa'])) {
    header("Location: ../login_mahasiswa.php");
    exit;
}

$cari = "";

if (isset($_GET['cari'])) {

    $cari = mysqli_real_escape_string($conn, $_GET['cari']);

    $query = mysqli_query($conn, "
        SELECT *
        FROM event
        WHERE
        (
            nama_event LIKE '%$cari%'
            OR kategori LIKE '%$cari%'
            OR lokasi LIKE '%$cari%'
        )
        AND tanggal >= CURDATE()
        ORDER BY tanggal ASC
    ");

} else {

    $query = mysqli_query($conn, "
        SELECT *
        FROM event
        WHERE tanggal >= CURDATE()
        ORDER BY tanggal ASC
    ");

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Mahasiswa</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="../assets/css/style.css">

<style>

body{
    background:linear-gradient(135deg,#0d6efd,#4f8cff,#74b9ff);
    background-size:400% 400%;
    animation:gradientMove 12s ease infinite;
    min-height:100vh;
    overflow-x:hidden;
    position:relative;
}

@keyframes gradientMove{
    0%{background-position:0% 50%;}
    50%{background-position:100% 50%;}
    100%{background-position:0% 50%;}
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
    background:#fff;
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
    background:#fff;
    bottom:-100px;
    left:40%;
    animation-delay:4s;
}

@keyframes float{
    0%{transform:translateY(0);}
    50%{transform:translateY(-25px);}
    100%{transform:translateY(0);}
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
    from{transform:translateX(0);}
    to{transform:translateX(1800px);}
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
    0%{transform:translateY(0) rotate(0deg);}
    50%{transform:translateY(-20px) rotate(10deg);}
    100%{transform:translateY(0) rotate(0deg);}
}

.card{
    border:none;
    border-radius:18px;
    backdrop-filter:blur(12px);
    background:rgba(255,255,255,.95);
    transition:.35s;
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 20px 35px rgba(0,0,0,.25);
}

.navbar{
    backdrop-filter:blur(10px);
    box-shadow:0 8px 20px rgba(0,0,0,.2);
}

.btn{
    transition:.3s;
}

.btn:hover{
    transform:scale(1.05);
}
.btn-success{
    border-radius:10px;
    font-weight:bold;
}

.btn-success:hover{
    transform:translateY(-2px);
}

.card{
    animation:fadeUp .7s ease;
}

@keyframes fadeUp{

from{
opacity:0;
transform:translateY(40px);
}

to{
opacity:1;
transform:translateY(0);
}

}
.card{
    animation:fadeUp .7s ease;
}

.card:nth-child(2){
    animation-delay:.2s;
}

.card:nth-child(3){
    animation-delay:.4s;
}
.custom-navbar{
    background:linear-gradient(90deg,#0b1f66,#1b3fa8,#2563eb);
    box-shadow:0 8px 25px rgba(0,0,0,.25);
}
.btn-detail{
    background:linear-gradient(90deg,#0b1f66,#2563eb);
    color:#fff;
    border:none;
    border-radius:10px;
    font-weight:bold;
    transition:.3s;
}

.btn-detail:hover{
    background:linear-gradient(90deg,#2563eb,#4f8cff);
    color:#fff;
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(37,99,235,.35);
}
.navbar-brand{
    font-size:30px;
    font-weight:700;
    letter-spacing:.5px;
}

.nav-link{
    font-size:18px;
    font-weight:500;
}

.nav-link:hover{
    color:#ffd54f !important;
}
</style>

</head>

<body>

<div class="cloud cloud1"></div>
<div class="cloud cloud2"></div>
<div class="cloud cloud3"></div>

<div class="bg-circle circle1"></div>
<div class="bg-circle circle2"></div>
<div class="bg-circle circle3"></div>

<i class="bi bi-mortarboard-fill floating-icon icon1"></i>
<i class="bi bi-book-fill floating-icon icon2"></i>
<i class="bi bi-laptop floating-icon icon3"></i>
<i class="bi bi-calendar-event floating-icon icon4"></i>

<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
<div class="container">

<a class="navbar-brand fw-bold" href="#">

🎓 Smart Event Campus

</a>

<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">

<span class="nav-link text-white">

👋 Halo, <strong><?= $_SESSION['nama']; ?></strong>

</span>

</li>

<li class="nav-item">

<a href="logout.php" class="nav-link">

Logout

</a>

</li>

</ul>

</div>

</div>

</nav>

<div class="container mt-5">

<?php
date_default_timezone_set("Asia/Jakarta");

$jam = date("H");

if($jam >=5 && $jam <11){
    $salam="🌅 Selamat Pagi";
}elseif($jam <15){
    $salam="☀ Selamat Siang";
}elseif($jam <18){
    $salam="🌇 Selamat Sore";
}else{
    $salam="🌙 Selamat Malam";
}
?>

<div class="mb-3 text-white">
    <h4><?= $salam; ?>, <?= $_SESSION['nama']; ?> 👋</h4>

    <div>📅 <span id="tanggal"></span></div>

    <div>🕒 <span id="jam"></span></div>
</div>

</div>

<div class="container mt-4">

<form method="GET">

<div class="input-group">

<span class="input-group-text">
<i class="bi bi-search"></i>
</span>

<input
type="text"
name="cari"
class="form-control"
placeholder="Cari nama event, lokasi..."
value="<?= $cari; ?>">

<button class="btn btn-success">
Cari
</button>

<a href="dashboard.php" class="btn btn-secondary">
Reset
</a>

</div>

</form>

</div>

<div class="container mt-5">

<h2 class="fw-bold mb-4 text-dark">
<i class="bi bi-calendar2-week-fill text-primary"></i>
Daftar Event Kampus
</h2>

<div class="row">

<?php

if(mysqli_num_rows($query)>0){

while($row=mysqli_fetch_assoc($query)){

?>

<div class="col-md-4 mb-4">

<div class="card shadow h-100">

<div class="card-body">

<h5 class="fw-bold">

<?= $row['nama_event']; ?>

</h5>

<hr>

<?php

switch($row['kategori']){

case "Seminar":

echo "<i class='bi bi-mic-fill text-primary me-2'></i>";
echo "<span class='badge bg-primary'>Seminar</span>";

break;

case "Workshop":

echo "<i class='bi bi-laptop text-success me-2'></i>";
echo "<span class='badge bg-success'>Workshop</span>";

break;

case "Lomba":

echo "<i class='bi bi-trophy-fill text-danger me-2'></i>";
echo "<span class='badge bg-danger'>Lomba</span>";

break;

default:

echo "<i class='bi bi-book-fill text-warning me-2'></i>";
echo "<span class='badge bg-warning text-dark'>Pelatihan</span>";

}
?>

<p class="mt-3">
<i class="bi bi-calendar-event text-primary"></i>
<?= date('d F Y', strtotime($row['tanggal'])); ?>
</p>

<p>
<i class="bi bi-geo-alt-fill text-danger"></i>
<?= $row['lokasi']; ?>
</p>

<p>
<i class="bi bi-people-fill text-success"></i>
Kuota : <?= $row['kuota']; ?>
</p>

<a href="detail.php?id=<?= $row['id_event']; ?>" class="btn btn-detail w-100">
    <i class="bi bi-eye"></i>
    Lihat Detail
</a>

</div>

</div>

</div>

<?php

}

}else{

?>

<div class="alert alert-danger">

Tidak ada event yang ditemukan.

</div>

<?php } ?>

</div>

</div>

<footer class="mt-5 bg-white border-top">

<div class="container py-4 text-center">

<h5 class="fw-bold">

<i class="bi bi-mortarboard-fill text-success"></i>

Smart Event Campus

</h5>

<p class="text-muted">
Sistem Informasi Kegiatan Mahasiswa
</p>

<p class="text-muted">
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