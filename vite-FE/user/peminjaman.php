<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Saya</title>

    <link rel="stylesheet" href="/perpustakaan-main/FE/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

    <?php include('../components/sidebar-user.php'); ?>

    <div class="main">

        <?php include('../components/topbar-user.php'); ?>

        <div class="page-header">
            <div>
                <p class="page-label">Peminjaman Saya</p>
                <h1>Kelola dan pantau status peminjaman buku kamu secara real-time.</h1>
            </div>
        </div>

        <div class="status-cards">
            <div class="status-card light-blue">
                <div>
                    <p class="status-label">Sedang Dipinjam</p>
                    <h3>3 Buku</h3>
                </div>
                <i class="fa-solid fa-book-open"></i>
            </div>
            <div class="status-card light-yellow">
                <div>
                    <p class="status-label">Sudah Dikembalikan</p>
                    <h3>12 Buku</h3>
                </div>
                <i class="fa-solid fa-check-circle"></i>
            </div>
            <div class="status-card light-red">
                <div>
                    <p class="status-label">Terlambat</p>
                    <h3>1 Buku</h3>
                </div>
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
        </div>

        <div class="loan-controls">
            <div class="search-book large">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Cari berdasarkan judul atau penulis...">
            </div>
            <div class="loan-filters">
                <button class="btn-outline secondary">Semua Status</button>
                <button class="btn-outline secondary">Urutkan</button>
            </div>
        </div>

        <div class="loan-list">
            <div class="loan-card loan-primary">
                <div class="loan-cover">
                    <img src="https://picsum.photos/120/170?21" alt="Design Systems">
                </div>
                <div class="loan-content">
                    <h3>Design Systems: Modern Architecture</h3>
                    <p>Oleh Alla Kholmatova</p>
                    <div class="loan-progress">
                        <span class="loan-status">SISA 7 HARI</span>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 50%;"></div>
                        </div>
                        <span class="loan-days">50%</span>
                    </div>
                    <div class="loan-dates">
                        <span>Pinjam: 12 Okt</span>
                        <span>Kembali: 26 Okt</span>
                    </div>
                </div>
                <div class="loan-action">
                    <span class="badge-blue">DIPINJAM</span>
                    <button class="btn-primary small">Perpanjang</button>
                </div>
            </div>

            <div class="loan-card loan-danger">
                <div class="loan-cover empty-cover"></div>
                <div class="loan-content">
                    <h3>Filosofi Teras</h3>
                    <p>Oleh Henry Manampiring</p>
                    <div class="loan-progress danger">
                        <span class="loan-status danger-text">TERLAMBAT 2 HARI</span>
                        <div class="progress-bar danger">
                            <div class="progress-fill" style="width: 100%;"></div>
                        </div>
                        <span class="loan-days">100%</span>
                    </div>
                    <div class="loan-dates">
                        <span>Pinjam: 01 Okt</span>
                        <span>Kembali: 15 Okt</span>
                    </div>
                </div>
                <div class="loan-action">
                    <span class="badge-red">TERLAMBAT</span>
                    <button class="btn-primary small">Perpanjang</button>
                </div>
            </div>

            <div class="loan-card loan-primary">
                <div class="loan-cover">
                    <img src="https://picsum.photos/120/170?22" alt="Creative Confidence">
                </div>
                <div class="loan-content">
                    <h3>Creative Confidence</h3>
                    <p>Oleh Tom & David Kelley</p>
                    <div class="loan-progress">
                        <span class="loan-status">SISA 12 HARI</span>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 15%;"></div>
                        </div>
                        <span class="loan-days">15%</span>
                    </div>
                    <div class="loan-dates">
                        <span>Pinjam: 20 Okt</span>
                        <span>Kembali: 03 Nov</span>
                    </div>
                </div>
                <div class="loan-action">
                    <span class="badge-blue">DIPINJAM</span>
                    <button class="btn-primary small">Perpanjang</button>
                </div>
            </div>
        </div>

        <div class="section-footer">
            <h3>Riwayat Terbaru</h3>
            <a href="riwayat.php" class="btn-outline">Lihat Semua</a>
        </div>

        <div class="history-row">
            <div class="history-card">
                <img src="https://picsum.photos/100/120?23" alt="Atomic Habits">
                <div>
                    <strong>Atomic Habits</strong>
                    <span>Dikembalikan 10 Okt</span>
                </div>
            </div>
            <div class="history-card">
                <img src="https://picsum.photos/100/120?24" alt="Zero to One">
                <div>
                    <strong>Zero to One</strong>
                    <span>Dikembalikan 08 Okt</span>
                </div>
            </div>
            <div class="history-card">
                <img src="https://picsum.photos/100/120?25" alt="Sprint">
                <div>
                    <strong>Sprint</strong>
                    <span>Dikembalikan 01 Okt</span>
                </div>
            </div>
            <div class="history-card">
                <img src="https://picsum.photos/100/120?26" alt="The Alchemist">
                <div>
                    <strong>The Alchemist</strong>
                    <span>Dikembalikan 25 Sep</span>
                </div>
            </div>
        </div>

    </div>

    <script src="/perpustakaan-main/FE/assets/js/script.js"></script>
</body>

</html>