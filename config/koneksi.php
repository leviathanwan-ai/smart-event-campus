<?php

$conn = mysqli_connect(
    "sql201.infinityfree.com",
    "if0_42418452",
    "Ftrhikwnsyh04",
    "if0_42418452_smart_event"
);

if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>