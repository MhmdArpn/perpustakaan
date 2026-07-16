<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist Saya</title>

    <link rel="stylesheet" href="/perpustakaan-main/FE/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

    <?php include('../components/sidebar-user.php'); ?>

    <div class="main">

        <?php include('../components/topbar-user.php'); ?>

        <div class="page-header">
            <div>
                <h1>Wishlist Saya</h1>
                <p>Simpan buku favoritmu untuk dibaca nanti.</p>
            </div>
        </div>

        <div class="cards" style="margin-bottom:18px;">
            <div class="card">
                <div>
                    <p style="text-transform:none;">TOTAL WISHLIST</p>
                    <h2>18 Buku</h2>
                </div>
            </div>
            <div class="card">
                <div>
                    <p style="text-transform:none;">AVAILABLE</p>
                    <h2>12 Buku</h2>
                </div>
            </div>
            <div class="card">
                <div>
                    <p style="text-transform:none;">BORROWED</p>
                    <h2>6 Buku</h2>
                </div>
            </div>
        </div>

        <div class="filter-bar">
            <div class="search-book">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Cari wishlist...">
            </div>
            <select>
                <option>Semua Kategori</option>
                <option>Programming</option>
                <option>Novel</option>
            </select>
            <button class="btn-outline">Filter</button>
        </div>

        <div class="books">
            <div class="book-card">
                <div class="book-image">
                    <img src="https://picsum.photos/200/300?1" alt="Atomic Habits">
                    <div class="wishlist-badge"><i class="fa-regular fa-heart"></i></div>
                </div>
                <h3>Atomic Habits</h3>
                <p>James Clear</p>
                <div class="book-meta">
                    <span class="badge-blue">AVAILABLE</span>
                    <span class="rating">★ 4.9</span>
                </div>
                <button>Pinjam</button>
            </div>

            <div class="book-card">
                <div class="book-image">
                    <img src="https://picsum.photos/200/300?2" alt="Psychology of Money">
                    <div class="wishlist-badge"><i class="fa-regular fa-heart"></i></div>
                </div>
                <h3>Psychology of Money</h3>
                <p>Morgan Housel</p>
                <div class="book-meta">
                    <span class="badge-red">BORROWED</span>
                    <span class="rating">★ 4.8</span>
                </div>
                <button class="btn-outline" disabled>Antri</button>
            </div>

            <div class="book-card">
                <div class="book-image">
                    <img src="https://picsum.photos/200/300?3" alt="Deep Work">
                    <div class="wishlist-badge"><i class="fa-regular fa-heart"></i></div>
                </div>
                <h3>Deep Work</h3>
                <p>Cal Newport</p>
                <div class="book-meta">
                    <span class="badge-blue">AVAILABLE</span>
                    <span class="rating">★ 4.7</span>
                </div>
                <button>Pinjam</button>
            </div>

            <div class="book-card">
                <div class="book-image">
                    <img src="https://picsum.photos/200/300?4" alt="Clean Code">
                    <div class="wishlist-badge"><i class="fa-regular fa-heart"></i></div>
                </div>
                <h3>Clean Code</h3>
                <p>Robert C. Martin</p>
                <div class="book-meta">
                    <span class="badge-warning">COMING SOON</span>
                    <span class="rating">★ 5.0</span>
                </div>
                <button class="btn-outline" disabled>Ingatkan Saya</button>
            </div>

            <div class="book-card">
                <div class="book-image">
                    <img src="https://picsum.photos/200/300?5" alt="Start With Why">
                    <div class="wishlist-badge"><i class="fa-regular fa-heart"></i></div>
                </div>
                <h3>Start With Why</h3>
                <p>Simon Sinek</p>
                <div class="book-meta">
                    <span class="badge-blue">AVAILABLE</span>
                    <span class="rating">★ 4.9</span>
                </div>
                <button>Pinjam</button>
            </div>

            <div class="book-card">
                <div class="book-image">
                    <img src="https://picsum.photos/200/300?6" alt="Thinking Fast and Slow">
                    <div class="wishlist-badge"><i class="fa-regular fa-heart"></i></div>
                </div>
                <h3>Thinking, Fast and Slow</h3>
                <p>Daniel Kahneman</p>
                <div class="book-meta">
                    <span class="badge-blue">AVAILABLE</span>
                    <span class="rating">★ 4.8</span>
                </div>
                <button>Pinjam</button>
            </div>

        </div>

    </div>

    <script src="/perpustakaan-main/FE/assets/js/script.js"></script>

</body>

</html>
