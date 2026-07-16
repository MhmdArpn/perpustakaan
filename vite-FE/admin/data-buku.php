<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Buku</title>
<link rel="stylesheet" href="/perpustakaan-main/FE/assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

<!-- Sidebar -->
<?php include('../components/sidebar-admin.php'); ?>

<div class="main">

<div class="topbar">

<div>

<h1>

Data Buku

</h1>

<p>

Kelola seluruh koleksi buku

</p>

</div>

<div class="top-right">

<div class="search">

<i class="fa-solid fa-magnifying-glass"></i>

<input

placeholder="Cari judul buku">

</div>

<div class="notif">

<i class="fa-regular fa-bell"></i>

</div>

<div class="avatar">

A

</div>

</div>

</div>


<div class="table-card">

<div class="table-header">

<h3>

Daftar Buku

</h3>

<button>

<i class="fa-solid fa-plus"></i>

Tambah Buku

</button>

</div>


<table>

<thead>

<tr>

<th>ID</th>

<th>Judul</th>

<th>Penulis</th>

<th>Kategori</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<tr>

<td>001</td>

<td>Algoritma Dasar</td>

<td>Abdul Kadir</td>

<td>Teknologi</td>

<td>

<span class="badge success">

Tersedia

</span>

</td>

<td>

<i class="fa-solid fa-pen-to-square edit"></i>

<i class="fa-solid fa-trash delete"></i>

</td>

</tr>

<tr>

<td>002</td>

<td>Basis Data</td>

<td>Rosa Shalahuddin</td>

<td>Komputer</td>

<td>

<span class="badge warning">

Dipinjam

</span>

</td>

<td>

<i class="fa-solid fa-pen-to-square edit"></i>

<i class="fa-solid fa-trash delete"></i>

</td>

</tr>

<tr>

<td>003</td>

<td>Pemrograman Web</td>

<td>Janner Simarmata</td>

<td>IT</td>

<td>

<span class="badge success">

Tersedia

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