<?php
$current = basename($_SERVER['PHP_SELF']);
function activeUser($page, $current) { return $page === $current ? 'active' : ''; }
?>

<div class="sidebar">

    <div class="brand">

        <div class="logo">📚</div>

        <div>
            <h3>USER</h3>
            <p>Sistem Perpustakaan Online</p>
        </div>

    </div>

    <ul>

        <li class="<?php echo activeUser('dashboard.php', $current); ?>">
            <a href="dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
        </li>

        <li class="<?php echo activeUser('cari-buku.php', $current); ?>">
            <a href="cari-buku.php"><i class="fa-solid fa-magnifying-glass"></i> Cari Buku</a>
        </li>

        <li class="<?php echo activeUser('kategori.php', $current); ?>">
            <a href="kategori.php"><i class="fa-solid fa-layer-group"></i> Kategori</a>
        </li>

        <li class="<?php echo activeUser('peminjaman.php', $current); ?>">
            <a href="peminjaman.php"><i class="fa-solid fa-book-open-reader"></i> Peminjaman Saya</a>
        </li>

        <li class="<?php echo activeUser('riwayat.php', $current); ?>">
            <a href="riwayat.php"><i class="fa-solid fa-clock-rotate-left"></i> Riwayat</a>
        </li>

        <li class="<?php echo activeUser('wishlist.php', $current); ?>">
            <a href="wishlist.php"><i class="fa-regular fa-heart"></i> Wishlist</a>
        </li>

        <li class="<?php echo activeUser('profile.php', $current); ?>">
            <a href="profile.php"><i class="fa-regular fa-user"></i> Profile</a>
        </li>

    </ul>

    <div class="logout">
        <a href="/perpustakaan-main/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>

</div>