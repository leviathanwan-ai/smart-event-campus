<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

$cari = "";

if(isset($_GET['cari'])){

    $cari = mysqli_real_escape_string($conn,$_GET['cari']);

    $data = mysqli_query($conn,"
        SELECT *
        FROM event
        WHERE
        nama_event LIKE '%$cari%'
        OR kategori LIKE '%$cari%'
        OR lokasi LIKE '%$cari%'
        OR penyelenggara LIKE '%$cari%'
        ORDER BY id_event DESC
    ");

}else{

    $data = mysqli_query($conn,"
        SELECT *
        FROM event
        ORDER BY id_event DESC
    ");

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Event</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="../assets/css/style.css">
<style>

body{
    background:linear-gradient(135deg,#0b1f66,#2563eb,#4f8cff);
    background-size:400% 400%;
    animation:gradientMove 12s ease infinite;
}

@keyframes gradientMove{
0%{background-position:0% 50%;}
50%{background-position:100% 50%;}
100%{background-position:0% 50%;}
}

.bg-circle{
position:fixed;
border-radius:50%;
filter:blur(10px);
opacity:.3;
z-index:-1;
animation:float 8s ease-in-out infinite;
}

.circle1{
width:250px;
height:250px;
background:white;
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
background:white;
bottom:-120px;
left:40%;
animation-delay:4s;
}

@keyframes float{

0%{transform:translateY(0);}
50%{transform:translateY(-25px);}
100%{transform:translateY(0);}

}

.cloud{

position:fixed;
background:white;
opacity:.15;
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

.floating-icon{

position:fixed;
font-size:38px;
color:white;
opacity:.15;
animation:floatIcon 8s ease-in-out infinite;
z-index:-1;

}

.icon1{top:15%;left:8%;}
.icon2{top:30%;right:10%;animation-delay:2s;}
.icon3{bottom:20%;left:20%;animation-delay:4s;}
.icon4{bottom:15%;right:15%;animation-delay:6s;}

@keyframes floatIcon{

0%{transform:translateY(0);}
50%{transform:translateY(-20px);}
100%{transform:translateY(0);}

}

.card{

border:none;
border-radius:20px;
animation:fadeUp .6s ease;
transition:.35s;

}

.card:hover{

transform:translateY(-6px);
box-shadow:0 20px 40px rgba(0,0,0,.2);

}

@keyframes fadeUp{

from{
opacity:0;
transform:translateY(40px);
}

to{
opacity:1;
transform:translateY(0);
}

}

</style>
</head>

<body style="
background:linear-gradient(135deg,#0b1f66,#2563eb);
min-height:100vh;
overflow-x:hidden;
position:relative;
">
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

<div class="container mt-5">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="text-white fw-bold">

<i class="bi bi-calendar-event"></i>

Data Event Kampus

</h2>

<p class="text-white">

Kelola seluruh kegiatan kampus seperti Seminar,
Workshop, Lomba, dan Pelatihan Mahasiswa.

</p>

</div>

</div>

<div class="mb-3">

<a href="dashboard.php"
class="btn btn-outline-light">
<i class="bi bi-arrow-left"></i>

Dashboard

</a>

<a href="tambah.php"
class="btn btn-primary">

<i class="bi bi-plus-circle"></i>

Tambah Event

</a>

</div>

<form method="GET" class="mb-4">

<div class="input-group">

<input
type="text"
name="cari"
class="form-control"
placeholder="Cari nama event, kategori, lokasi..."
value="<?= $cari; ?>">

<button
class="btn btn-primary">

<i class="bi bi-search"></i>

Cari

</button>

<a href="event.php"
class="btn btn-outline-secondary">

Reset

</a>

</div>

</form>

<div class="card shadow-lg border-0 rounded-4">

<div class="card-body">

<table class="table table-bordered table-hover align-middle">

<thead class="text-center text-white"
style="background:linear-gradient(90deg,#0b1f66,#2563eb);">

<tr>

<th>No</th>

<th>Nama Event</th>

<th>Kategori</th>

<th>Tanggal</th>

<th>Lokasi</th>

<th>Penyelenggara</th>

<th>Kuota</th>

<th width="180">Aksi</th>

</tr>

</thead>

<tbody>

<?php

if(mysqli_num_rows($data)>0){

$no=1;

while($row=mysqli_fetch_assoc($data)){

?>

<tr>

<td class="text-center">

<?= $no++; ?>

</td>

<td>

<?= $row['nama_event']; ?>

</td>

<td>

<?php

if($row['kategori']=="Seminar"){

echo "<span class='badge bg-primary'>Seminar</span>";

}elseif($row['kategori']=="Workshop"){

echo "<span class='badge bg-success'>Workshop</span>";

}elseif($row['kategori']=="Lomba"){

echo "<span class='badge bg-danger'>Lomba</span>";

}else{

echo "<span class='badge bg-warning text-dark'>Pelatihan</span>";

}

?>

</td>

<td>

<?= date('d-m-Y',strtotime($row['tanggal'])); ?>

</td>

<td>

<?= $row['lokasi']; ?>

</td>

<td>

<?= $row['penyelenggara']; ?>

</td>

<td class="text-center">

<?= $row['kuota']; ?>

</td>

<td class="text-center">
    <a href="edit.php?id=<?= $row['id_event']; ?>" class="btn btn-outline-warning btn-sm">
    <i class="bi bi-pencil-square"></i> Edit
</a>

<a href="hapus.php?id=<?= $row['id_event']; ?>"
   class="btn btn-outline-danger btn-sm btn-hapus">
    <i class="bi bi-trash"></i> Hapus
</a>
</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="8" class="text-center text-danger">

<i class="bi bi-exclamation-circle"></i>

Data tidak ditemukan.

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

<div class="text-center mt-4">

<p class="text-muted">

© 2026 Smart Event Campus | Sistem Informasi Kegiatan Kampus

</p>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.btn-hapus').forEach(function(btn){

    btn.addEventListener('click', function(e){

        e.preventDefault();

        const url = this.getAttribute('href');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data event yang dihapus tidak bisa dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result)=>{

            if(result.isConfirmed){
                window.location = url;
            }

        });

    });

});
</script>

<?php if(isset($_GET['sukses']) && $_GET['sukses']=="tambah"){ ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: 'Data event berhasil ditambahkan.',
    confirmButtonColor: '#2563eb'
});
</script>
<?php if(isset($_GET['sukses']) && $_GET['sukses']=="hapus"){ ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: 'Data event berhasil dihapus.',
    confirmButtonColor: '#2563eb'
});
</script>
<?php } ?>
<?php } ?>

</body>
</html>

