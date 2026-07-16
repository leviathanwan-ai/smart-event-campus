<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Registrasi Mahasiswa</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body class="bg-light">

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header bg-success text-white text-center">

<h3>Registrasi Mahasiswa</h3>

</div>

<div class="card-body">

<?php
if(isset($_GET['error'])){
?>

<div class="alert alert-danger">

<?= $_GET['error']; ?>

</div>

<?php
}

if(isset($_GET['success'])){
?>

<div class="alert alert-success">

Registrasi berhasil.

Silakan login.

</div>

<?php
}
?>

<form action="proses_register.php" method="POST">

<div class="mb-3">

<label>Nama Lengkap</label>

<input
type="text"
name="nama"
class="form-control"
required>

</div>

<div class="mb-3">

<label>NIM</label>

<input
type="text"
name="nim"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Konfirmasi Password</label>

<input
type="password"
name="konfirmasi"
class="form-control"
required>

</div>

<button class="btn btn-success w-100">

Daftar

</button>

</form>

<hr>

<div class="text-center">

Sudah punya akun?

<a href="login_mahasiswa.php">

Login

</a>

</div>

</div>

</div>

</div>

</div>

</div>

</body>

</html>