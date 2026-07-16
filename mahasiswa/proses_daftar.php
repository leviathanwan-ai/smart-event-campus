<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['mahasiswa'])) {
    header("Location: ../login_mahasiswa.php");
    exit;
}

$id_event = $_GET['id'];
$id_mahasiswa = $_SESSION['id_mahasiswa'];

/* ===========================
   CEK SUDAH PERNAH DAFTAR
=========================== */

$cek = mysqli_query($conn,"
SELECT *
FROM pendaftaran
WHERE id_event='$id_event'
AND id_mahasiswa='$id_mahasiswa'
");

if(mysqli_num_rows($cek)>0){
    header("Location: detail.php?id=$id_event&status=sudah");
exit;
}
/* ===========================
   CEK KUOTA
=========================== */

$event = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT *
FROM event
WHERE id_event='$id_event'
"));

if($event['kuota'] <= 0){

   header("Location: detail.php?id=$id_event&status=penuh");
exit;
}
/* ===========================
   SIMPAN PENDAFTARAN
=========================== */

mysqli_query($conn,"
INSERT INTO pendaftaran(id_event,id_mahasiswa)
VALUES('$id_event','$id_mahasiswa')
");
/* ===========================
   KURANGI KUOTA
=========================== */

mysqli_query($conn,"
UPDATE event
SET kuota = kuota - 1
WHERE id_event='$id_event'
");

header("Location: detail.php?id=$id_event&sukses=1");
exit;