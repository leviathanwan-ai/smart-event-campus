<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM event WHERE id_event='$id'");
$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $tanggal = $_POST['tanggal'];
    $lokasi = $_POST['lokasi'];
    $penyelenggara = $_POST['penyelenggara'];
    $kuota = $_POST['kuota'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($conn,"UPDATE event SET

    nama_event='$nama',
    kategori='$kategori',
    tanggal='$tanggal',
    lokasi='$lokasi',
    penyelenggara='$penyelenggara',
    kuota='$kuota',
    deskripsi='$deskripsi'

    WHERE id_event='$id'
    ");

    echo "<script>

    alert('Data berhasil diupdate');

    window.location='event.php';

    </script>";

}

?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<title>Edit Event</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Edit Event</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Nama Event</label>

<input
type="text"
name="nama"
class="form-control"
value="<?= $row['nama_event']; ?>"
required>

</div>

<div class="mb-3">

<label>Kategori</label>

<select
name="kategori"
class="form-control">

<option <?=($row['kategori']=="Seminar")?"selected":"";?>>
Seminar
</option>

<option <?=($row['kategori']=="Workshop")?"selected":"";?>>
Workshop
</option>

<option <?=($row['kategori']=="Lomba")?"selected":"";?>>
Lomba
</option>

<option <?=($row['kategori']=="Pelatihan")?"selected":"";?>>
Pelatihan
</option>

</select>

</div>

<div class="mb-3">

<label>Tanggal</label>

<input
type="date"
name="tanggal"
class="form-control"
value="<?= $row['tanggal']; ?>"
required>

</div>

<div class="mb-3">

<label>Lokasi</label>

<input
type="text"
name="lokasi"
class="form-control"
value="<?= $row['lokasi']; ?>"
required>

</div>

<div class="mb-3">

<label>Penyelenggara</label>

<input
type="text"
name="penyelenggara"
class="form-control"
value="<?= $row['penyelenggara']; ?>"
required>

</div>

<div class="mb-3">

<label>Kuota</label>

<input
type="number"
name="kuota"
class="form-control"
value="<?= $row['kuota']; ?>"
required>

</div>

<div class="mb-3">

<label>Deskripsi</label>

<textarea
name="deskripsi"
rows="4"
class="form-control"><?= $row['deskripsi']; ?></textarea>

</div>

<button
type="submit"
name="update"
class="btn btn-warning">

Update

</button>

<a href="event.php" class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</body>

</html>