<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Member</title>

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

Member

</h1>

<p>

Kelola data anggota perpustakaan

</p>

</div>

<div class="top-right">

<div class="search">

<i class="fa-solid fa-magnifying-glass"></i>

<input

placeholder="Cari member">

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

<p>Total Member</p>

<h2>540</h2>

</div>

<i class="fa-solid fa-users"></i>

</div>


<div class="card">

<div>

<p>Aktif</p>

<h2>510</h2>

</div>

<i class="fa-solid fa-user-check"></i>

</div>


<div class="card">

<div>

<p>Baru Bulan Ini</p>

<h2>25</h2>

</div>

<i class="fa-solid fa-user-plus"></i>

</div>


<div class="card">

<div>

<p>Premium</p>

<h2>75</h2>

</div>

<i class="fa-solid fa-crown"></i>

</div>

</div>



<div class="table-card">

<div class="table-header">

<h3>

Daftar Member

</h3>

<button>

<i class="fa-solid fa-plus"></i>

Tambah Member

</button>

</div>


<table>

<thead>

<tr>

<th>ID</th>

<th>Nama</th>

<th>Email</th>

<th>Telepon</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<tr>

<td>MB001</td>

<td>Budi Santoso</td>

<td>budi@gmail.com</td>

<td>08123456789</td>

<td>

<span class="badge success">

Aktif

</span>

</td>

<td>

<i class="fa-solid fa-pen-to-square edit"></i>

<i class="fa-solid fa-trash delete"></i>

</td>

</tr>


<tr>

<td>MB002</td>

<td>Siti Aminah</td>

<td>siti@gmail.com</td>

<td>081356987412</td>

<td>

<span class="badge warning">

Pending

</span>

</td>

<td>

<i class="fa-solid fa-pen-to-square edit"></i>

<i class="fa-solid fa-trash delete"></i>

</td>

</tr>


<tr>

<td>MB003</td>

<td>Ryan King</td>

<td>ryan@gmail.com</td>

<td>082113459876</td>

<td>

<span class="badge success">

Aktif

</span>

</td>

<td>

<i class="fa-solid fa-pen-to-square edit"></i>

<i class="fa-solid fa-trash delete"></i>

</td>

</tr>


<tr>

<td>MB004</td>

<td>Anna Wong</td>

<td>anna@gmail.com</td>

<td>082298765432</td>

<td>

<span class="badge danger">

Nonaktif

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