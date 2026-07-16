<?php
include "config/koneksi.php";

$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$nim = mysqli_real_escape_string($conn, $_POST['nim']);
$password = $_POST['password'];
$konfirmasi = $_POST['konfirmasi'];

// Cek apakah password sama
if ($password != $konfirmasi) {
    header("Location: register_mahasiswa.php?error=Konfirmasi password tidak sesuai!");
    exit;
}

// Cek apakah NIM sudah terdaftar
$cek = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim'");

if (mysqli_num_rows($cek) > 0) {
    header("Location: register_mahasiswa.php?error=NIM sudah terdaftar!");
    exit;
}

// Enkripsi password
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Simpan ke database
$query = mysqli_query($conn, "INSERT INTO mahasiswa(nama,nim,password)
VALUES('$nama','$nim','$passwordHash')");

if ($query) {

    header("Location: register_mahasiswa.php?success=1");
    exit;

} else {

    header("Location: register_mahasiswa.php?error=Registrasi gagal!");
    exit;

}
?>