<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Pengembalian</title>

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

Pengembalian

</h1>

<p>

Kelola transaksi pengembalian buku

</p>

</div>

<div class="top-right">

<div class="search">

<i class="fa-solid fa-magnifying-glass"></i>

<input

placeholder="Cari pengembalian">

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

<p>Total Kembali</p>

<h2>180</h2>

</div>

<i class="fa-solid fa-book"></i>

</div>

<div class="card">

<div>

<p>Hari Ini</p>

<h2>12</h2>

</div>

<i class="fa-solid fa-calendar"></i>

</div>

<div class="card">

<div>

<p>Terlambat</p>

<h2>8</h2>

</div>

<i class="fa-solid fa-clock"></i>

</div>

<div class="card">

<div>

<p>Total Denda</p>

<h2>Rp350K</h2>

</div>

<i class="fa-solid fa-money-bill"></i>

</div>

</div>



<div class="table-card">

<div class="table-header">

<h3>

Daftar Pengembalian

</h3>

<button>

<i class="fa-solid fa-plus"></i>

Tambah Pengembalian

</button>

</div>


<table>

<thead>

<tr>

<th>ID</th>

<th>User</th>

<th>Buku</th>

<th>Tanggal Kembali</th>

<th>Keterlambatan</th>

<th>Denda</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<tr>

<td>#RT5501</td>

<td>Sarah Miller</td>

<td>Modern History</td>

<td>15 Oct 2023</td>

<td>-</td>

<td>-</td>

<td>

<span class="badge success">

Kembali

</span>

</td>

</tr>


<tr>

<td>#RT5502</td>

<td>Ryan King</td>

<td>Beyond Stars</td>

<td>18 Oct 2023</td>

<td>

3 Hari

</td>

<td>

Rp15.000

</td>

<td>

<span class="badge danger">

Terlambat

</span>

</td>

</tr>


<tr>

<td>#RT5503</td>

<td>Anna Wong</td>

<td>Global Markets</td>

<td>20 Oct 2023</td>

<td>

-

</td>

<td>

-

</td>

<td>

<span class="badge warning">

Pending

</span>

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