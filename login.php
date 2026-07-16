<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: admin/dashboard.php");
    exit;
}

if (isset($_SESSION['mahasiswa'])) {
    header("Location: mahasiswa/dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Smart Event Campus</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/login.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
background:linear-gradient(135deg,#0d6efd,#3b82f6);
height:100vh;
display:flex;
justify-content:center;
align-items:center;
}

.card{
border:none;
border-radius:20px;
box-shadow:0 15px 40px rgba(0,0,0,.2);
}

.logo{
font-size:60px;
color:#0d6efd;
}

.form-check{
margin-bottom:8px;
}

</style>

</head>

<body>
<div class="circle c1"></div>
<div class="circle c2"></div>
<div class="container">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card">

<div class="card-body p-5">

<div class="text-center">

<i class="bi bi-mortarboard-fill logo"></i>

<h2 class="fw-bold mt-3">

Smart Event Campus

</h2>

<p class="text-muted">

Sistem Informasi Kegiatan Kampus

</p>

</div>

<?php
if(isset($_GET['error'])){
?>

<div class="alert alert-danger">

Username / NIM atau Password salah!

</div>

<?php
}
?>

<form action="proses_login.php" method="POST" autocomplete="off">

<div class="mb-3">

<label class="fw-bold">

Username / NIM

</label>

<input
type="text"
name="username"
class="form-control"
placeholder="Masukkan Username atau NIM"
autocomplete="off"
required>

</div>

<div class="mb-3">

<label class="fw-bold">

Password

</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Masukkan Password"
autocomplete="new-password"
required>

</div>

<div class="mb-3">

<label class="fw-bold">

Login Sebagai

</label>

<div class="form-check">

<input
class="form-check-input"
type="radio"
name="role"
value="admin"
checked>

<label class="form-check-label">

👨‍💼 Admin

</label>

</div>

<div class="form-check">

<input
class="form-check-input"
type="radio"
name="role"
value="mahasiswa">

<label class="form-check-label">

👨‍🎓 Mahasiswa

</label>

</div>

</div>

<button class="btn btn-primary w-100">

<i class="bi bi-box-arrow-in-right"></i>

Login

</button>

</form>

<hr>

<div class="text-center">

Belum punya akun mahasiswa?

<br>

<a href="register_mahasiswa.php"
class="btn btn-success mt-2">

<i class="bi bi-person-plus-fill"></i>

Daftar Sekarang

</a>

</div>

</div>

</div>

</div>

</div>

</div>

<script>
window.onload = function () {
    document.querySelector("form").reset();
};
</script>
<script>

window.onload=function(){

document.querySelector("form").reset();

}

</script>
</body>

</html>