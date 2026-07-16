<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard User</title>

    <link rel="stylesheet" href="/perpustakaan-main/FE/assets/css/style.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <?php include('../components/sidebar-user.php'); ?>

    <div class="main">

        <?php include('../components/topbar-user.php'); ?>


        <!-- HERO -->

        <div class="hero-card">

            <div class="hero-content">

                <h1>Halo 👋 Selamat Datang</h1>

                <p>

                    Selamat datang di Sistem Perpustakaan Online.

                    Temukan lebih dari 10.000+ koleksi buku digital terbaru hari ini.

                </p>

                <button>

                    Mulai Jelajah

                </button>

            </div>

            <div class="hero-image">

                <img src="https://picsum.photos/250/180">

            </div>

        </div>


        <!-- FILTER -->

        <div class="book-filter">

            <div class="search-book">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input type="text"

                    placeholder="Cari buku favoritmu...">

            </div>


            <button>

                <i class="fa-solid fa-filter"></i>

                Kategori

            </button>


            <button>

                <i class="fa-solid fa-pen"></i>

                Penulis

            </button>

        </div>


        <!-- KATEGORI -->

        <div class="section-title">

            <h2>Kategori Populer</h2>

            <a href="#">Lihat Semua</a>

        </div>


        <div class="categories">

            <div class="category-card blue">

                Programming

            </div>


            <div class="category-card yellow">

                Novel

            </div>


            <div class="category-card green">

                Finance

            </div>


            <div class="category-card purple">

                Science

            </div>


            <div class="category-card orange">

                History

            </div>

        </div>


        <!-- BUKU -->

        <div class="section-title">

            <h2>Buku Terpopuler</h2>

        </div>


        <div class="books">

            <div class="book-card">

                <img src="https://picsum.photos/200/300?1">

                <h3>Atomic Habits</h3>

                <p>James Clear</p>

                <button>

                    Pinjam

                </button>

            </div>


            <div class="book-card">

                <img src="https://picsum.photos/200/300?2">

                <h3>Clean Code</h3>

                <p>Robert C Martin</p>

                <button>

                    Pinjam

                </button>

            </div>


            <div class="book-card">

                <img src="https://picsum.photos/200/300?3">

                <h3>Psychology Of Money</h3>

                <p>Morgan Housel</p>

                <button>

                    Pinjam

                </button>

            </div>


            <div class="book-card">

                <img src="https://picsum.photos/200/300?4">

                <h3>Harry Potter</h3>

                <p>J.K Rowling</p>

                <button>

                    Pinjam

                </button>

            </div>


        </div>


        <!-- RIWAYAT -->

        <div class="table-card">

            <div class="table-header">

                <h3>Riwayat Peminjaman</h3>

                <button>

                    <i class="fa-solid fa-download"></i>

                    Laporan

                </button>

            </div>


            <table>

                <thead>

                    <tr>

                        <th>Buku</th>

                        <th>Tanggal Pinjam</th>

                        <th>Deadline</th>

                        <th>Status</th>

                    </tr>

                </thead>


                <tbody>

                    <tr>

                        <td>Atomic Habits</td>

                        <td>12 Okt 2023</td>

                        <td>19 Okt 2023</td>

                        <td>

                            <span class="badge info">

                                Dipinjam

                            </span>

                        </td>

                    </tr>


                    <tr>

                        <td>Clean Code</td>

                        <td>05 Okt 2023</td>

                        <td>12 Okt 2023</td>

                        <td>

                            <span class="badge success">

                                Dikembalikan

                            </span>

                        </td>

                    </tr>


                    <tr>

                        <td>Psychology Of Money</td>

                        <td>20 Sep 2023</td>

                        <td>27 Sep 2023</td>

                        <td>

                            <span class="badge danger">

                                Terlambat

                            </span>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>


    <script src="/perpustakaan-main/FE/assets/js/script.js"></script>

</body>

</html>