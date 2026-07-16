<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM event WHERE id_event='$id'");

header("Location: event.php?sukses=hapus");
exit;
?>