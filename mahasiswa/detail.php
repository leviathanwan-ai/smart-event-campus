<?php
session_start();
include "../config/koneksi.php";

// Cek apakah mahasiswa sudah login
if (!isset($_SESSION['mahasiswa'])) {
    header("Location: ../login_mahasiswa.php");
    exit;
}

// Cek apakah ada ID event
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

$query = mysqli_query($conn, "SELECT * FROM event WHERE id_event='$id'");

if (mysqli_num_rows($query) == 0) {
    header("Location: dashboard.php");
    exit;
}

$data = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Detail Event</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="../assets/css/style.css">

<style>
.custom-navbar{
    background: linear-gradient(90deg,#0b1f66,#1b3fa8,#2563eb);
    box-shadow:0 8px 25px rgba(0,0,0,.25);
}
</style>

</head>

<body class="bg-light">

<<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">

<div class="container">

<a class="navbar-brand fw-bold" href="dashboard.php">

🎓 Smart Event Campus

</a>

<div class="ms-auto">

<span class="text-white me-3">

👋 <?= $_SESSION['nama']; ?>

</span>

<a href="logout.php" class="btn btn-outline-light btn-sm">

Logout

</a>

</div>

</div>

</nav>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header text-white"
     style="background:linear-gradient(90deg,#0b1f66,#1b3fa8,#2563eb);">
<h3 class="mb-0">

<?= $data['nama_event']; ?>

</h3>

</div>

<div class="card-body">

<div class="row mb-3">

<div class="col-md-3 fw-bold">
Kategori
</div>

<div class="col-md-9">

<?php
switch($data['kategori']){

case "Seminar":
echo "<span class='badge bg-primary'>Seminar</span>";
break;

case "Workshop":
echo "<span class='badge bg-success'>Workshop</span>";
break;

case "Lomba":
echo "<span class='badge bg-danger'>Lomba</span>";
break;

default:
echo "<span class='badge bg-warning text-dark'>Pelatihan</span>";
}
?>

</div>

</div>

<hr>

<div class="row mb-3">

<div class="col-md-3 fw-bold">

📅 Tanggal

</div>

<div class="col-md-9">

<?= date('d F Y', strtotime($data['tanggal'])); ?>

</div>

</div>

<div class="row mb-3">

<div class="col-md-3 fw-bold">

📍 Lokasi

</div>

<div class="col-md-9">

<?= $data['lokasi']; ?>

</div>

</div>

<div class="row mb-3">

<div class="col-md-3 fw-bold">

🏢 Penyelenggara

</div>

<div class="col-md-9">

<?= $data['penyelenggara']; ?>

</div>

</div>

<div class="row mb-3">

<div class="col-md-3 fw-bold">

👥 Kuota

</div>

<div class="col-md-9">

<?= $data['kuota']; ?> Peserta

</div>

</div>

<div class="row mb-3">

    <div class="col-md-3 fw-bold">
        📝 Deskripsi
    </div>

    <div class="col-md-9">
        <?= nl2br($data['deskripsi']); ?>
    </div>

</div>

<hr>

<div class="d-flex justify-content-center gap-3 mt-4">
    <a href="proses_daftar.php?id=<?= $data['id_event']; ?>"
   class="btn btn-primary px-4">
        <i class="bi bi-person-plus-fill"></i>
        Daftar Event
    </a>

    <a href="dashboard.php"
       class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>

</div>
</div>

</div>

</div>

<footer class="text-center text-white mt-5 p-4"
style="background:linear-gradient(90deg,#0b1f66,#1b3fa8,#2563eb);">
© 2026 Smart Event Campus

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if(isset($_GET['sukses'])){ ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Pendaftaran Berhasil!',
    text: 'Anda berhasil mendaftar event <?= $data['nama_event']; ?>',
    confirmButtonColor: '#2563eb'
});
</script>
<?php } ?>


<?php if(isset($_GET['status']) && $_GET['status']=="sudah"){ ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Sudah Terdaftar',
    text: 'Kamu sudah terdaftar pada event <?= $data['nama_event']; ?>.',
    confirmButtonColor: '#2563eb'
});
</script>
<?php } ?>

<?php if(isset($_GET['status']) && $_GET['status']=="penuh"){ ?>
<script>
Swal.fire({
    icon: 'warning',
    title: 'Kuota Penuh',
    text: 'Maaf, kuota event <?= $data['nama_event']; ?> sudah penuh.',
    confirmButtonColor: '#2563eb'
});
</script>
<?php } ?>
</body>

</html>