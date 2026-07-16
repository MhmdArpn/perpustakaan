<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin</title>
<link rel="stylesheet" href="/perpustakaan-main/FE/assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

<!-- Sidebar -->
<?php include('../components/sidebar-admin.php'); ?>

<!-- Main -->
<div class="main">

    <div class="topbar">
        <div>
            <h1>Dashboard</h1>
            <p>Selamat Datang Admin</p>
        </div>
        <div class="top-right">
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Cari data...">
            </div>
            <div class="notif">
                <i class="fa-regular fa-bell"></i>
            </div>
            <div class="avatar">A</div>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="cards">
        <div class="card">
            <div>
                <p>Total Buku</p>
                <h2>1.250</h2>
            </div>
            <i class="fa-solid fa-book"></i>
        </div>
        <div class="card">
            <div>
                <p>Peminjaman</p>
                <h2>215</h2>
            </div>
            <i class="fa-solid fa-book-open-reader"></i>
        </div>
        <div class="card">
            <div>
                <p>Member</p>
                <h2>542</h2>
            </div>
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="card">
            <div>
                <p>Denda</p>
                <h2>Rp350K</h2>
            </div>
            <i class="fa-solid fa-wallet"></i>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">

        <div class="activity">
            <h3>Aktivitas Terbaru</h3>
            <div class="item">
                <div class="circle blue"></div>
                <p>Andi meminjam buku Algoritma Dasar</p>
            </div>
            <div class="item">
                <div class="circle green"></div>
                <p>Siti mengembalikan buku Basis Data</p>
            </div>
            <div class="item">
                <div class="circle orange"></div>
                <p>Budi terlambat mengembalikan buku</p>
            </div>
            <div class="item">
                <div class="circle blue"></div>
                <p>Rina menambahkan buku baru</p>
            </div>
        </div>

        <div class="quick">
            <h3>Quick Action</h3>
            <button>Tambah Buku</button>
            <button>Tambah Member</button>
            <button>Cetak Laporan</button>
        </div>

    </div>

</div>

    <script src="/perpustakaan-main/FE/assets/js/script.js"></script>
</body>
</html>