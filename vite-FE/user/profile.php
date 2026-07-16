<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Saya</title>
    <link rel="stylesheet" href="/perpustakaan-main/FE/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

    <?php include('../components/sidebar-user.php'); ?>

    <div class="main">

        <?php include('../components/topbar-user.php'); ?>

        <div class="page-header">
            <div>
                <h1>Profile Saya</h1>
                <p>Kelola informasi akun dan aktivitas perpustakaan</p>
            </div>
        </div>

        <div class="profile-card card">
            <div class="profile-left">
                <div class="profile-avatar">
                    <img src="https://picsum.photos/120/120?face" alt="avatar">
                </div>
                <div class="profile-info">
                    <h2>Ahmad Rizky</h2>
                    <p class="muted">ahmad@gmail.com</p>
                    <p class="muted small">Bergabung sejak 2023</p>
                </div>
            </div>
            <div class="profile-actions">
                <button class="btn-primary">Edit Profile</button>
            </div>
        </div>

        <div class="cards" style="margin-top:18px;">
            <div class="card small-card">
                <p>TOTAL DIBACA</p>
                <h3>24</h3>
            </div>
            <div class="card small-card">
                <p>SEDANG PINJAM</p>
                <h3>3</h3>
            </div>
            <div class="card small-card">
                <p>WISHLIST</p>
                <h3>12</h3>
            </div>
            <div class="card small-card">
                <p>TERLAMBAT</p>
                <h3>1</h3>
            </div>
        </div>

        <div class="grid-2" style="gap:18px; margin-top:18px;">
            <div class="card form-card">
                <h3>Informasi Pribadi <span class="muted small right"><a href="#">Perbarui</a></span></h3>
                <div class="info-grid">
                    <div class="input-field">
                        <label>Nama Lengkap</label>
                        <input type="text" value="Ahmad Rizky">
                    </div>
                    <div class="input-field">
                        <label>Email</label>
                        <input type="email" value="ahmad@gmail.com">
                    </div>
                    <div class="input-field">
                        <label>Nomor HP</label>
                        <input type="text" value="+62 812-3456-7890">
                    </div>
                    <div class="input-field">
                        <label>Alamat</label>
                        <textarea>Jl. Menteng No. 42, Jakarta Pusat</textarea>
                    </div>
                </div>
                <div class="note">
                    Data ini digunakan untuk keperluan verifikasi pengiriman buku fisik dan notifikasi keterlambatan.
                </div>
            </div>

            <div class="card settings-card">
                <h3>Pengaturan Akun</h3>
                <ul class="settings-list">
                    <li><i class="fa-solid fa-lock"></i> Ubah Password <span class="muted small">&gt;</span></li>
                    <li><i class="fa-solid fa-bell"></i> Notifikasi <span class="muted small">&gt;</span></li>
                    <li class="toggle-row"><i class="fa-solid fa-moon"></i> Dark Mode <label class="switch"><input type="checkbox"><span class="slider"></span></label></li>
                    <li class="danger"><i class="fa-solid fa-sign-out-alt"></i> Logout <span class="muted small">&gt;</span></li>
                </ul>
            </div>
        </div>

    </div>

    <script src="/perpustakaan-main/FE/assets/js/script.js"></script>
</body>

</html>
