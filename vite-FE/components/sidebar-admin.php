<?php
$current = basename($_SERVER['PHP_SELF']);
function activeAdmin($page, $current) { return $page === $current ? 'active' : ''; }
?>

<div class="sidebar">

    <div class="brand">

        <div class="logo">📚</div>

        <div>
            <h3>ADMIN</h3>
            <p>Sistem Perpustakaan Online</p>
        </div>

    </div>

	<ul>

		<li class="<?php echo activeAdmin('dashboard.php', $current); ?>">
			<a href="dashboard.php"><i class="fa-solid fa-house"></i>Dashboard</a>
		</li>

		<li class="<?php echo activeAdmin('data-buku.php', $current); ?>">
			<a href="data-buku.php"><i class="fa-solid fa-book"></i>Data Buku</a>
		</li>

		<li class="<?php echo activeAdmin('kategori.php', $current); ?>">
			<a href="kategori.php"><i class="fa-solid fa-tags"></i>Kategori</a>
		</li>

		<li class="<?php echo activeAdmin('peminjaman.php', $current); ?>">
			<a href="peminjaman.php"><i class="fa-solid fa-book-open-reader"></i>Peminjaman</a>
		</li>

		<li class="<?php echo activeAdmin('pengembalian.php', $current); ?>">
			<a href="pengembalian.php"><i class="fa-solid fa-undo"></i>Pengembalian</a>
		</li>

		<li class="<?php echo activeAdmin('member.php', $current); ?>">
			<a href="member.php"><i class="fa-solid fa-users"></i>Member</a>
		</li>

		<li class="<?php echo activeAdmin('denda.php', $current); ?>">
			<a href="denda.php"><i class="fa-solid fa-money-bill"></i>Denda</a>
		</li>

		<li class="<?php echo activeAdmin('laporan.php', $current); ?>">
			<a href="laporan.php"><i class="fa-solid fa-file-alt"></i>Laporan</a>
		</li>

	</ul>

<div class="logout">
			<a href="/perpustakaan-main/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>
	
</div>