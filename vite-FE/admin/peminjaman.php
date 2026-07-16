<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Peminjaman</title>
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
            <h1>Peminjaman</h1>
            <p>Kelola transaksi peminjaman buku</p>
        </div>
        <div class="top-right">
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Cari anggota">
            </div>
            <div class="notif">
                <i class="fa-regular fa-bell"></i>
            </div>
            <div class="avatar">A</div>
        </div>
    </div>

    <div class="table-card">

        <div class="table-header">
            <h3>Daftar Peminjaman</h3>
            <button>
                <i class="fa-solid fa-plus"></i>
                Tambah Peminjaman
            </button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>PM001</td>
                    <td>Budi Santoso</td>
                    <td>The Clean Coder</td>
                    <td>12 Okt 2023</td>
                    <td>26 Okt 2023</td>
                    <td><span class="badge info">Dipinjam</span></td>
                    <td>
                        <i class="fa-solid fa-eye edit"></i>
                        <i class="fa-solid fa-trash delete"></i>
                    </td>
                </tr>
                <tr>
                    <td>PM002</td>
                    <td>Siti Aminah</td>
                    <td>Atomic Habits</td>
                    <td>08 Okt 2023</td>
                    <td>22 Okt 2023</td>
                    <td><span class="badge success">Selesai</span></td>
                    <td>
                        <i class="fa-solid fa-eye edit"></i>
                        <i class="fa-solid fa-trash delete"></i>
                    </td>
                </tr>
                <tr>
                    <td>PM003</td>
                    <td>Raka Pratama</td>
                    <td>React Design</td>
                    <td>01 Okt 2023</td>
                    <td>15 Okt 2023</td>
                    <td><span class="badge danger">Terlambat</span></td>
                    <td>
                        <i class="fa-solid fa-eye edit"></i>
                        <i class="fa-solid fa-trash delete"></i>
                    </td>
                </tr>
                <tr>
                    <td>PM004</td>
                    <td>Ani Wijaya</td>
                    <td>Sapiens</td>
                    <td>14 Okt 2023</td>
                    <td>28 Okt 2023</td>
                    <td><span class="badge info">Dipinjam</span></td>
                    <td>
                        <i class="fa-solid fa-eye edit"></i>
                        <i class="fa-solid fa-trash delete"></i>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="pagination">
            <button>&lt;</button>
            <button class="current">1</button>
            <button>2</button>
            <button>3</button>
            <button>&gt;</button>
        </div>

    </div>

</div>

<script src="/perpustakaan-main/FE/assets/js/script.js"></script>
</body>
</html>