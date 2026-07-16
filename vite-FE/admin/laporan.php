<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Laporan</title>

<link rel="stylesheet" href="/perpustakaan-main/FE/assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>
    
<!-- Sidebar -->
<?php include('../components/sidebar-admin.php'); ?>

<div class="main">

<div class="topbar">

<div>

<h1>

Laporan

</h1>

<p>

Kelola laporan perpustakaan

</p>

</div>

<div class="top-right">

<div class="search">

<i class="fa-solid fa-magnifying-glass"></i>

<input
placeholder="Cari laporan">

</div>

<div class="notif">

<i class="fa-regular fa-bell"></i>

</div>

<div class="avatar">

A

</div>

</div>

</div>



<div class="cards">

<div class="card">

<div>

<p>Total Laporan</p>

<h2>120</h2>

</div>

<i class="fa-solid fa-file"></i>

</div>


<div class="card">

<div>

<p>Peminjaman</p>

<h2>540</h2>

</div>

<i class="fa-solid fa-book-open-reader"></i>

</div>


<div class="card">

<div>

<p>Pengembalian</p>

<h2>180</h2>

</div>

<i class="fa-solid fa-arrow-rotate-left"></i>

</div>


<div class="card">

<div>

<p>Total Denda</p>

<h2>Rp350K</h2>

</div>

<i class="fa-solid fa-money-bill-wave"></i>

</div>

</div>



<div class="table-card">

<div class="table-header">

<h3>

Daftar Laporan

</h3>

<button>

<i class="fa-solid fa-download"></i>

Export PDF

</button>

</div>



<table>

<thead>

<tr>

<th>ID</th>

<th>Jenis</th>

<th>Tanggal</th>

<th>Total</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<tr>

<td>LP001</td>

<td>Peminjaman</td>

<td>01 Juli 2026</td>

<td>210</td>

<td>

<span class="badge success">

Selesai

</span>

</td>

<td>

<i class="fa-solid fa-eye edit"></i>

<i class="fa-solid fa-download edit"></i>

</td>

</tr>


<tr>

<td>LP002</td>

<td>Pengembalian</td>

<td>02 Juli 2026</td>

<td>180</td>

<td>

<span class="badge success">

Selesai

</span>

</td>

<td>

<i class="fa-solid fa-eye edit"></i>

<i class="fa-solid fa-download edit"></i>

</td>

</tr>


<tr>

<td>LP003</td>

<td>Denda</td>

<td>03 Juli 2026</td>

<td>Rp350K</td>

<td>

<span class="badge warning">

Pending

</span>

</td>

<td>

<i class="fa-solid fa-eye edit"></i>

<i class="fa-solid fa-download edit"></i>

</td>

</tr>

</tbody>

</table>



<div class="pagination">

<button>

<

</button>

<button class="current">

1

</button>

<button>

2

</button>

<button>

3

</button>

<button>

>

</button>

</div>

</div>

</div>

	<script src="/perpustakaan-main/FE/assets/js/script.js"></script>

</body>

</html>