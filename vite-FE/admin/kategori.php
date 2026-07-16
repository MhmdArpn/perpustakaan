<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kategori Buku</title>
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
            <h1>Kategori Buku</h1>
            <p>Kelola kategori koleksi perpustakaan</p>
        </div>
        <div class="top-right">
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Cari kategori">
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
                <p>Total Kategori</p>
                <h2>12</h2>
            </div>
            <i class="fa-solid fa-layer-group"></i>
        </div>
        <div class="card">
            <div>
                <p>Kategori Aktif</p>
                <h2>10</h2>
            </div>
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div class="card">
            <div>
                <p>Baru Ditambahkan</p>
                <h2>2</h2>
            </div>
            <i class="fa-solid fa-plus"></i>
        </div>
    </div>

    <!-- Table -->
    <div class="table-card">

        <div class="table-header">
            <h3>Daftar Kategori</h3>
            <button>
                <i class="fa-solid fa-plus"></i>
                Tambah Kategori
            </button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Buku</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>KT001</td>
                    <td>Teknologi</td>
                    <td>120</td>
                    <td><span class="badge success">Aktif</span></td>
                    <td>
                        <i class="fa-solid fa-pen-to-square edit"></i>
                        <i class="fa-solid fa-trash delete"></i>
                    </td>
                </tr>
                <tr>
                    <td>KT002</td>
                    <td>Sains</td>
                    <td>75</td>
                    <td><span class="badge success">Aktif</span></td>
                    <td>
                        <i class="fa-solid fa-pen-to-square edit"></i>
                        <i class="fa-solid fa-trash delete"></i>
                    </td>
                </tr>
                <tr>
                    <td>KT003</td>
                    <td>Novel</td>
                    <td>55</td>
                    <td><span class="badge warning">Nonaktif</span></td>
                    <td>
                        <i class="fa-solid fa-pen-to-square edit"></i>
                        <i class="fa-solid fa-trash delete"></i>
                    </td>
                </tr>
                <tr>
                    <td>KT004</td>
                    <td>Pendidikan</td>
                    <td>82</td>
                    <td><span class="badge success">Aktif</span></td>
                    <td>
                        <i class="fa-solid fa-pen-to-square edit"></i>
                        <i class="fa-solid fa-trash delete"></i>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="pagination">
            <button>&lt;</button>
            <button class="current">1</button>
            <button>2</button>
            <button>&gt;</button>
        </div>

    </div>

</div>

    <script src="/perpustakaan-main/FE/assets/js/script.js"></script>
</body>
</html>