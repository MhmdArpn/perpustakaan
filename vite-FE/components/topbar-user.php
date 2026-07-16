<div class="topbar">


<div>

<?php
$page = basename($_SERVER['PHP_SELF']);

$topbarTitle = 'Dashboard';
$topbarSubtitle = 'Selamat Datang Member';

switch ($page) {
    case 'cari-buku.php':
        $topbarTitle = 'Cari Buku';
        $topbarSubtitle = 'Temukan koleksi buku yang kamu cari';
        break;
    case 'kategori.php':
        $topbarTitle = 'Kategori';
        $topbarSubtitle = 'Jelajahi berbagai kategori buku';
        break;
    case 'peminjaman.php':
        $topbarTitle = 'Peminjaman Saya';
        $topbarSubtitle = 'Pantau buku yang sedang kamu pinjam';
        break;
    case 'riwayat.php':
        $topbarTitle = 'Riwayat';
        $topbarSubtitle = 'Lihat sejarah peminjaman kamu';
        break;
    case 'wishlist.php':
        $topbarTitle = 'Wishlist';
        $topbarSubtitle = 'Buku favorit yang ingin kamu simpan';
        break;
    case 'profile.php':
        $topbarTitle = 'Profile';
        $topbarSubtitle = 'Kelola informasi akun kamu';
        break;
    default:
        $topbarTitle = 'Dashboard';
        $topbarSubtitle = 'Selamat Datang Member';
        break;
}
?>

<h1><?php echo $topbarTitle; ?></h1>

<p><?php echo $topbarSubtitle; ?></p>

</div>


<div class="top-right">

<div class="search">

<i class="fa-solid fa-magnifying-glass"></i>

<input

type="text"

placeholder="Cari buku..."

>

</div>


<div class="notif">

<i class="fa-regular fa-bell"></i>

</div>


<div class="notif">

<i class="fa-solid fa-gear"></i>

</div>


<div class="avatar">

U

</div>

</div>

</div>