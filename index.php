<?php
include "config/koneksi.php";

$cari = "";

if(isset($_GET['cari'])){
    $cari = mysqli_real_escape_string($conn,$_GET['cari']);

    $query = mysqli_query($conn,"
    SELECT *
    FROM event
    WHERE
    nama_event LIKE '%$cari%'
    OR kategori LIKE '%$cari%'
    OR lokasi LIKE '%$cari%'
    ORDER BY tanggal ASC
    ");

}else{

    $query = mysqli_query($conn,"
    SELECT *
    FROM event
    ORDER BY tanggal ASC
    ");

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Smart Event Campus</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

<div class="container">

<a class="navbar-brand fw-bold" href="#">

🎓 Smart Event Campus

</a>

<button
class="navbar-toggler"
data-bs-toggle="collapse"
data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">

<a class="nav-link active" href="index.php">

Beranda

</a>

</li>

<li class="nav-item">

<a class="nav-link" href="login.php">

Login Admin

</a>

</li>

</ul>

</div>

</div>

</nav>

<!-- HERO -->

<div class="container mt-5">

<div class="p-5 rounded bg-primary text-white shadow">

<h1 class="fw-bold">

Selamat Datang di Smart Event Campus

</h1>

<p>

Temukan berbagai informasi seminar, workshop,
lomba, dan pelatihan mahasiswa.

</p>

</div>

</div>

<!-- SEARCH -->

<div class="container mt-4">

<form method="GET">

<div class="input-group">

<input
type="text"
name="cari"
class="form-control"
placeholder="Cari nama event, kategori, atau lokasi..."
value="<?= $cari ?>">

<button class="btn btn-primary">

<i class="bi bi-search"></i>

Cari

</button>

<a href="index.php"
class="btn btn-secondary">

Reset

</a>

</div>

</form>

</div>

<!-- DAFTAR EVENT -->

<div class="container mt-5">

<h2 class="mb-4">

📅 Event Kampus

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

if($row['kategori']=="Seminar"){

echo "<span class='badge bg-primary'>Seminar</span>";

}elseif($row['kategori']=="Workshop"){

echo "<span class='badge bg-success'>Workshop</span>";

}elseif($row['kategori']=="Lomba"){

echo "<span class='badge bg-danger'>Lomba</span>";

}else{

echo "<span class='badge bg-warning text-dark'>Pelatihan</span>";

}

?>

<p class="mt-3">

📅

<?= date('d F Y',strtotime($row['tanggal'])); ?>

</p>

<p>

📍

<?= $row['lokasi']; ?>

</p>

<p>

👥 Kuota :

<?= $row['kuota']; ?>

</p>

<a
href="detail.php?id=<?= $row['id_event']; ?>"
class="btn btn-primary w-100">

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

Data Event Tidak Ditemukan

</div>

<?php } ?>

</div>

</div>

<footer class="bg-dark text-white text-center mt-5 p-3">

© 2026 Smart Event Campus

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>