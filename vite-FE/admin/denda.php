<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Denda</title>

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

Denda

</h1>

<p>

Kelola seluruh data denda perpustakaan

</p>

</div>

<div class="top-right">

<div class="search">

<i class="fa-solid fa-magnifying-glass"></i>

<input

placeholder="Cari denda">

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

<p>Total Denda</p>

<h2>Rp350K</h2>

</div>

<i class="fa-solid fa-money-bill-wave"></i>

</div>


<div class="card">

<div>

<p>Belum Bayar</p>

<h2>28</h2>

</div>

<i class="fa-solid fa-circle-exclamation"></i>

</div>


<div class="card">

<div>

<p>Lunas</p>

<h2>145</h2>

</div>

<i class="fa-solid fa-circle-check"></i>

</div>


<div class="card">

<div>

<p>Bulan Ini</p>

<h2>Rp95K</h2>

</div>

<i class="fa-solid fa-chart-line"></i>

</div>

</div>



<div class="table-card">

<div class="table-header">

<h3>

Data Denda

</h3>

<button>

<i class="fa-solid fa-plus"></i>

Tambah Denda

</button>

</div>


<table>

<thead>

<tr>

<th>ID</th>

<th>Member</th>

<th>Buku</th>

<th>Keterlambatan</th>

<th>Denda</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<tr>

<td>DN001</td>

<td>Budi Santoso</td>

<td>Atomic Habits</td>

<td>3 Hari</td>

<td>Rp15.000</td>

<td>

<span class="badge warning">

Belum Bayar

</span>

</td>

<td>

<i class="fa-solid fa-pen-to-square edit"></i>

<i class="fa-solid fa-trash delete"></i>

</td>

</tr>


<tr>

<td>DN002</td>

<td>Siti Aminah</td>

<td>Sapiens</td>

<td>1 Hari</td>

<td>Rp5.000</td>

<td>

<span class="badge success">

Lunas

</span>

</td>

<td>

<i class="fa-solid fa-pen-to-square edit"></i>

<i class="fa-solid fa-trash delete"></i>

</td>

</tr>


<tr>

<td>DN003</td>

<td>Ryan King</td>

<td>Modern History</td>

<td>7 Hari</td>

<td>Rp35.000</td>

<td>

<span class="badge danger">

Terlambat

</span>

</td>

<td>

<i class="fa-solid fa-pen-to-square edit"></i>

<i class="fa-solid fa-trash delete"></i>

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