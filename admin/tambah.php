<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

if(isset($_POST['simpan'])){

    $nama=$_POST['nama'];
    $kategori=$_POST['kategori'];
    $tanggal=$_POST['tanggal'];
    $lokasi=$_POST['lokasi'];
    $penyelenggara=$_POST['penyelenggara'];
    $kuota=$_POST['kuota'];
    $deskripsi=$_POST['deskripsi'];

    mysqli_query($conn,"INSERT INTO event
    (nama_event,kategori,tanggal,lokasi,penyelenggara,kuota,deskripsi)

    VALUES

    ('$nama',
    '$kategori',
    '$tanggal',
    '$lokasi',
    '$penyelenggara',
    '$kuota',
    '$deskripsi')
    ");

    header("Location: event.php?sukses=tambah");
exit;

}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<style>

.card{
    animation: fadeUp .6s ease;
}

@keyframes fadeUp{

    from{
        opacity:0;
        transform:translateY(30px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }

}
.btn{

    transition:.3s;

}

.btn:hover{

    transform:translateY(-3px);

    box-shadow:0 10px 20px rgba(0,0,0,.15);

}
.form-control{

    border-radius:12px;

    padding:12px;

    transition:.3s;

}

.form-control:focus{

    border-color:#2563eb;

    box-shadow:0 0 15px rgba(37,99,235,.25);

}
.card{

    transition:.35s;

}

.card:hover{

    transform:translateY(-6px);

    box-shadow:0 20px 45px rgba(0,0,0,.18);

}
body{
    background:linear-gradient(135deg,#0d6efd,#4f8cff,#74b9ff);
    background-size:400% 400%;
    animation:gradientMove 12s ease infinite;
    min-height:100vh;
    overflow-x:hidden;
    position:relative;
}

@keyframes gradientMove{
    0%{background-position:0% 50%;}
    50%{background-position:100% 50%;}
    100%{background-position:0% 50%;}
}

/* Lingkaran */
.bg-circle{
    position:fixed;
    border-radius:50%;
    filter:blur(10px);
    opacity:.35;
    z-index:-1;
    animation:float 8s ease-in-out infinite;
}

.circle1{
    width:250px;
    height:250px;
    background:#fff;
    top:-60px;
    left:-70px;
}

.circle2{
    width:180px;
    height:180px;
    background:#87cefa;
    right:60px;
    top:120px;
    animation-delay:2s;
}

.circle3{
    width:320px;
    height:320px;
    background:#fff;
    bottom:-100px;
    left:40%;
    animation-delay:4s;
}

@keyframes float{
    0%{transform:translateY(0);}
    50%{transform:translateY(-25px);}
    100%{transform:translateY(0);}
}

/* Awan */
.cloud{
    position:fixed;
    background:white;
    opacity:.18;
    border-radius:100px;
    animation:cloudMove linear infinite;
    z-index:-2;
}

.cloud::before{
    content:"";
    position:absolute;
    width:70px;
    height:70px;
    background:white;
    border-radius:50%;
    top:-30px;
    left:20px;
}

.cloud::after{
    content:"";
    position:absolute;
    width:90px;
    height:90px;
    background:white;
    border-radius:50%;
    top:-45px;
    right:20px;
}

.cloud1{
    width:220px;
    height:70px;
    top:80px;
    left:-250px;
    animation-duration:28s;
}

.cloud2{
    width:170px;
    height:60px;
    top:180px;
    left:-200px;
    animation-duration:40s;
    animation-delay:8s;
}

.cloud3{
    width:250px;
    height:80px;
    top:40px;
    left:-280px;
    animation-duration:50s;
    animation-delay:15s;
}

@keyframes cloudMove{
    from{transform:translateX(0);}
    to{transform:translateX(1800px);}
}

/* Icon */
.floating-icon{
    position:fixed;
    font-size:38px;
    opacity:.18;
    color:white;
    animation:floatIcon 8s ease-in-out infinite;
    z-index:-1;
}

.icon1{top:18%;left:8%;}
.icon2{top:30%;right:12%;animation-delay:2s;}
.icon3{bottom:22%;left:25%;animation-delay:4s;}
.icon4{bottom:12%;right:20%;animation-delay:6s;}

@keyframes floatIcon{
    0%{transform:translateY(0) rotate(0);}
    50%{transform:translateY(-20px) rotate(10deg);}
    100%{transform:translateY(0) rotate(0);}
}
</style>
<title>Tambah Event</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:linear-gradient(135deg,#0b1f66,#2563eb); min-height:100vh;">
<div class="cloud cloud1"></div>
<div class="cloud cloud2"></div>
<div class="cloud cloud3"></div>

<div class="bg-circle circle1"></div>
<div class="bg-circle circle2"></div>
<div class="bg-circle circle3"></div>

<i class="bi bi-calendar-event floating-icon icon1"></i>
<i class="bi bi-mortarboard-fill floating-icon icon2"></i>
<i class="bi bi-laptop floating-icon icon3"></i>
<i class="bi bi-book-fill floating-icon icon4"></i>
<div class="container py-5">

<div class="card shadow-lg border-0 rounded-4">

<div class="card-header text-white"
style="background:linear-gradient(90deg,#0b1f66,#2563eb);">

<h3>
<i class="bi bi-calendar-plus-fill"></i>
Tambah Event
</h3>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Nama Event</label>

<input
type="text"
name="nama"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Kategori</label>

<select
name="kategori"
class="form-control">

<option>Seminar</option>

<option>Workshop</option>

<option>Lomba</option>

<option>Pelatihan</option>

</select>

</div>

<div class="mb-3">

<label>Tanggal</label>

<input
type="date"
name="tanggal"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Lokasi</label>

<input
type="text"
name="lokasi"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Penyelenggara</label>

<input
type="text"
name="penyelenggara"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Kuota</label>

<input
type="number"
name="kuota"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Deskripsi</label>

<textarea
name="deskripsi"
class="form-control"
rows="4"></textarea>

</div>

<button
type="submit"
name="simpan"
class="btn btn-success">

Simpan

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