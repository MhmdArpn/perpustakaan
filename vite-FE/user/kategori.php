<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>

    <link rel="stylesheet" href="/perpustakaan-main/FE/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

    <?php include('../components/sidebar-user.php'); ?>

    <div class="main">

        <?php include('../components/topbar-user.php'); ?>

        <div class="page-header">
            <div>
                <p class="page-label">Kategori Buku</p>
                <h1>Jelajahi kategori favoritmu dan temukan pengetahuan baru</h1>
            </div>
            <a href="dashboard.php" class="btn-outline">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>
        </div>

        <div class="category-row">
            <div class="category-card blue">
                <div class="category-icon"><i class="fa-solid fa-code"></i></div>
                <strong>Programming</strong>
                <span>120 Buku</span>
            </div>
            <div class="category-card yellow">
                <div class="category-icon"><i class="fa-solid fa-book-open"></i></div>
                <strong>Novel</strong>
                <span>85 Buku</span>
            </div>
            <div class="category-card green">
                <div class="category-icon"><i class="fa-solid fa-flask"></i></div>
                <strong>Science</strong>
                <span>60 Buku</span>
            </div>
            <div class="category-card purple">
                <div class="category-icon"><i class="fa-solid fa-chart-line"></i></div>
                <strong>Finance</strong>
                <span>42 Buku</span>
            </div>
            <div class="category-card orange">
                <div class="category-icon"><i class="fa-solid fa-landmark"></i></div>
                <strong>History</strong>
                <span>30 Buku</span>
            </div>
            <div class="category-card gray">
                <div class="category-icon"><i class="fa-solid fa-pencil-alt"></i></div>
                <strong>UI/UX</strong>
                <span>55 Buku</span>
            </div>
        </div>

        <div class="section-title">
            <div>
                <h2>Buku Berdasarkan Kategori: Programming</h2>
                <p class="section-subtitle">Menampilkan koleksi buku teknologi dan pengembangan perangkat lunak</p>
            </div>
            <a href="cari-buku.php" class="btn-outline">Lihat Semua</a>
        </div>

        <div class="books category-books">
            <div class="book-card">
                <div class="book-image">
                    <img src="https://picsum.photos/200/280?15" alt="Clean Code">
                    <span class="rating">4.9</span>
                </div>
                <h3>Clean Code</h3>
                <p>Robert C. Martin</p>
                <div class="book-meta">
                    <span class="badge-blue">Available</span>
                    <a class="bookmark"><i class="fa-regular fa-bookmark"></i></a>
                </div>
            </div>

            <div class="book-card">
                <div class="book-image">
                    <img src="https://picsum.photos/200/280?16" alt="Eloquent JavaScript">
                    <span class="rating">4.8</span>
                </div>
                <h3>Eloquent JavaScript</h3>
                <p>Marijn Haverbeke</p>
                <div class="book-meta">
                    <span class="badge-red">Borrowed</span>
                    <a class="bookmark"><i class="fa-regular fa-bookmark"></i></a>
                </div>
            </div>

            <div class="book-card">
                <div class="book-image">
                    <img src="https://picsum.photos/200/280?17" alt="Pragmatic Programmer">
                    <span class="rating">5.0</span>
                </div>
                <h3>Pragmatic Programmer</h3>
                <p>Andrew Hunt</p>
                <div class="book-meta">
                    <span class="badge-blue">Available</span>
                    <a class="bookmark"><i class="fa-regular fa-bookmark"></i></a>
                </div>
            </div>

            <div class="book-card">
                <div class="book-image">
                    <img src="https://picsum.photos/200/280?18" alt="Refactoring">
                    <span class="rating">4.7</span>
                </div>
                <h3>Refactoring</h3>
                <p>Martin Fowler</p>
                <div class="book-meta">
                    <span class="badge-blue">Available</span>
                    <a class="bookmark"><i class="fa-regular fa-bookmark"></i></a>
                </div>
            </div>

            <div class="book-card">
                <div class="book-image">
                    <img src="https://picsum.photos/200/280?19" alt="Design Patterns">
                    <span class="rating">4.9</span>
                </div>
                <h3>Design Patterns</h3>
                <p>Erich Gamma</p>
                <div class="book-meta">
                    <span class="badge-blue">Available</span>
                    <a class="bookmark"><i class="fa-regular fa-bookmark"></i></a>
                </div>
            </div>
        </div>

    </div>

    <script src="/perpustakaan-main/FE/assets/js/script.js"></script>
</body>

</html>
