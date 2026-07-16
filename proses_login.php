<?php
session_start();
include "config/koneksi.php";

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];
$role = $_POST['role'];

// ===================
// LOGIN ADMIN
// ===================
if ($role == "admin") {

    $data = mysqli_query($conn, "SELECT * FROM admin
    WHERE username='$username'
    AND password='$password'");

    if (mysqli_num_rows($data) > 0) {

        $_SESSION['login'] = true;

        header("Location: admin/dashboard.php");
        exit;

    } else {

        echo "<script>
        alert('Username atau Password Admin Salah!');
        window.location='login.php';
        </script>";

    }

}

// ===================
// LOGIN MAHASISWA
// ===================
else {

    $data = mysqli_query($conn,
    "SELECT * FROM mahasiswa
    WHERE nim='$username'");

    if (mysqli_num_rows($data) > 0) {

        $mhs = mysqli_fetch_assoc($data);

        if (
            password_verify($password, $mhs['password']) ||
            $password == $mhs['password']
        ) {

            $_SESSION['mahasiswa'] = true;
            $_SESSION['id_mahasiswa'] = $mhs['id_mahasiswa'];
            $_SESSION['nama'] = $mhs['nama'];
            $_SESSION['nim'] = $mhs['nim'];

            header("Location: mahasiswa/dashboard.php");
            exit;

        }

    }

    echo "<script>
    alert('NIM atau Password Mahasiswa Salah!');
    window.location='login.php';
    </script>";

}
?>