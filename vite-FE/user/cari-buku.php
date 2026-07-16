<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Buku</title>

    <link rel="stylesheet" href="/perpustakaan-main/FE/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

    <?php include('../components/sidebar-user.php'); ?>

    <div class="main">

        <?php include('../components/topbar-user.php'); ?>

        <div class="page-header">
            <div>
                <p class="page-label">Cari Buku</p>
                <h1>Temukan koleksi buku yang kamu cari</h1>
            </div>
            <a href="dashboard.php" class="btn-outline">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>
        </div>

        <div class="search-panel">
            <div class="search-book large">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Cari judul buku, penulis, atau kategori...">
            </div>
            <button class="btn-primary">
                <i class="fa-solid fa-search"></i>
                Cari Sekarang
            </button>
        </div>

        <div class="filter-bar modern-filter">
            <select id="filterCategory">
                <option value="all">Semua Kategori</option>
                <option value="programming">Programming</option>
                <option value="novel">Novel</option>
                <option value="finance">Finance</option>
                <option value="science">Science</option>
            </select>

            <select id="filterStatus">
                <option value="all">Semua Status</option>
                <option value="tersedia">Tersedia</option>
                <option value="dipinjam">Dipinjam</option>
            </select>

            <select id="filterSort">
                <option value="default">Urutkan</option>
                <option value="az">A-Z</option>
                <option value="za">Z-A</option>
            </select>

            <button class="btn-outline secondary">
                <i class="fa-solid fa-rotate-right"></i>
                Reset
            </button>
        </div>

        <div class="section-title">
            <h2>Hasil Pencarian</h2>
            <span class="result-count">24 buku tersedia</span>
        </div>

        <div class="books">
            <div class="book-card" data-title="atomic habits" data-author="james clear" data-category="self improvement" data-status="tersedia">
                <img src="https://picsum.photos/200/300?10">
                <h3>Atomic Habits</h3>
                <p>James Clear</p>
                <div class="book-meta">
                    <span class="badge-blue">Self Improvement</span>
                    <span class="badge-green">Tersedia</span>
                </div>
                <button>Pinjam</button>
            </div>

            <div class="book-card" data-title="clean code" data-author="robert c. martin" data-category="programming" data-status="tersedia">
                <img src="https://picsum.photos/200/300?11">
                <h3>Clean Code</h3>
                <p>Robert C. Martin</p>
                <div class="book-meta">
                    <span class="badge-blue">Programming</span>
                    <span class="badge-green">Tersedia</span>
                </div>
                <button>Pinjam</button>
            </div>

            <div class="book-card" data-title="psychology of money" data-author="morgan housel" data-category="finance" data-status="tersedia">
                <img src="https://picsum.photos/200/300?12">
                <h3>Psychology of Money</h3>
                <p>Morgan Housel</p>
                <div class="book-meta">
                    <span class="badge-blue">Finance</span>
                    <span class="badge-green">Tersedia</span>
                </div>
                <button>Pinjam</button>
            </div>

            <div class="book-card" data-title="harry potter" data-author="j.k. rowling" data-category="novel" data-status="dipinjam">
                <img src="https://picsum.photos/200/300?13">
                <h3>Harry Potter</h3>
                <p>J.K. Rowling</p>
                <div class="book-meta">
                    <span class="badge-blue">Novel</span>
                    <span class="badge-red">Dipinjam</span>
                </div>
                <button disabled>Dipinjam</button>
            </div>
        </div>

    </div>

    <script src="/perpustakaan-main/FE/assets/js/script.js"></script>
</body>

</html>
