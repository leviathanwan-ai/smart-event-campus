<?php
session_start();
include "config/koneksi.php";

$nim = mysqli_real_escape_string($conn, $_POST['nim']);
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim'");

if (mysqli_num_rows($query) > 0) {

    $data = mysqli_fetch_assoc($query);

    // Cek password (support password_hash DAN password lama)
    if (
        password_verify($password, $data['password']) ||
        $password === $data['password']
    ) {

        $_SESSION['mahasiswa'] = true;
        $_SESSION['id_mahasiswa'] = $data['id_mahasiswa'];
        $_SESSION['nim'] = $data['nim'];
        $_SESSION['nama'] = $data['nama'];

        header("Location: mahasiswa/dashboard.php");
        exit;

    } else {

        header("Location: login_mahasiswa.php?error=1");
        exit;

    }

} else {

    header("Location: login_mahasiswa.php?error=1");
    exit;

}
?>