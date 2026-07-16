<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman</title>

    <link rel="stylesheet" href="/perpustakaan-main/FE/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

    <?php include('../components/sidebar-user.php'); ?>

    <div class="main">

        <?php include('../components/topbar-user.php'); ?>

        <div class="page-header">
            <div>
                <p class="page-label">Riwayat Peminjaman</p>
                <h1>Lihat semua histori peminjaman dan pengembalian buku</h1>
            </div>
        </div>

        <div class="history-overview">
            <div class="history-card-summary">
                <div>
                    <p>Total Dipinjam</p>
                    <h3>25 Buku</h3>
                    <span>Update: Hari ini</span>
                </div>
                <i class="fa-solid fa-book-open"></i>
            </div>
            <div class="history-card-summary">
                <div>
                    <p>Dikembalikan</p>
                    <h3>22 Buku</h3>
                    <span>88% Tingkat pengembalian</span>
                </div>
                <i class="fa-solid fa-check-circle"></i>
            </div>
            <div class="history-card-summary danger-card">
                <div>
                    <p>Terlambat</p>
                    <h3>3 Buku</h3>
                    <span>Memerlukan tindakan segera</span>
                </div>
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
        </div>

        <div class="history-filters">
            <div class="history-search search-book large">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Cari buku...">
            </div>
            <div class="history-actions">
                <select>
                    <option>Status</option>
                    <option>Dikembalikan</option>
                    <option>Terlambat</option>
                    <option>Dipinjam</option>
                </select>
                <select>
                    <option>Bulan</option>
                    <option>Oktober</option>
                    <option>September</option>
                    <option>Agustus</option>
                </select>
            </div>
        </div>

        <div class="history-list">
            <div class="history-item">
                <div class="history-line"></div>
                <div class="history-media">
                    <img src="https://picsum.photos/110/140?31" alt="Atomic Habits">
                </div>
                <div class="history-details">
                    <div class="history-info">
                        <h3>Atomic Habits</h3>
                        <p>Oleh: James Clear</p>
                    </div>
                    <div class="history-meta">
                        <span><i class="fa-solid fa-calendar-days"></i> Dipinjam: 12 Okt 2023</span>
                        <span><i class="fa-solid fa-calendar-check"></i> Dikembalikan: 19 Okt 2023</span>
                    </div>
                </div>
                <div class="history-status">
                    <span class="badge-blue">DIKEMBALIKAN</span>
                    <a href="#">Detail Transaksi</a>
                </div>
            </div>

            <div class="history-item">
                <div class="history-line red"></div>
                <div class="history-media">
                    <img src="https://picsum.photos/110/140?32" alt="Psychology of Money">
                </div>
                <div class="history-details">
                    <div class="history-info">
                        <h3>Psychology of Money</h3>
                        <p>Oleh: Morgan Housel</p>
                    </div>
                    <div class="history-meta">
                        <span><i class="fa-solid fa-calendar-days"></i> Dipinjam: 01 Okt 2023</span>
                        <span><i class="fa-solid fa-calendar-check"></i> Batas: 08 Okt 2023</span>
                    </div>
                </div>
                <div class="history-status">
                    <span class="badge-red">TERLAMBAT</span>
                    <a href="#">Bayar Denda</a>
                </div>
            </div>

            <div class="history-item">
                <div class="history-line"></div>
                <div class="history-media">
                    <img src="https://picsum.photos/110/140?33" alt="Deep Work">
                </div>
                <div class="history-details">
                    <div class="history-info">
                        <h3>Deep Work</h3>
                        <p>Oleh: Cal Newport</p>
                    </div>
                    <div class="history-meta">
                        <span><i class="fa-solid fa-calendar-days"></i> Dipinjam: 20 Sep 2023</span>
                        <span><i class="fa-solid fa-calendar-check"></i> Dikembalikan: 27 Sep 2023</span>
                    </div>
                </div>
                <div class="history-status">
                    <span class="badge-blue">DIKEMBALIKAN</span>
                    <a href="#">Detail Transaksi</a>
                </div>
            </div>
        </div>

        <div class="pagination-row">
            <button><i class="fa-solid fa-chevron-left"></i></button>
            <button class="page-active">1</button>
            <button>2</button>
            <button>3</button>
            <button><i class="fa-solid fa-chevron-right"></i></button>
        </div>

    </div>

    <script src="/perpustakaan-main/FE/assets/js/script.js"></script>
</body>

</html>