<div class="topbar">
    <div>
        @if(request()->routeIs('member.search'))
            <h1>Cari Buku</h1>
            <p>Temukan koleksi buku yang kamu cari</p>
        @elseif(request()->routeIs('member.categories'))
            <h1>Kategori</h1>
            <p>Jelajahi berbagai kategori buku</p>
        @elseif(request()->routeIs('member.loans'))
            <h1>Peminjaman Saya</h1>
            <p>Pantau buku yang sedang kamu pinjam</p>
        @elseif(request()->routeIs('member.history'))
            <h1>Riwayat</h1>
            <p>Lihat sejarah peminjaman kamu</p>
        @elseif(request()->routeIs('member.wishlist'))
            <h1>Wishlist</h1>
            <p>Buku favorit yang ingin kamu simpan</p>
        @elseif(request()->routeIs('member.profile'))
            <h1>Profile</h1>
            <p>Kelola informasi akun kamu</p>
        @else
            <h1>Dashboard</h1>
            <p>Selamat Datang Member</p>
        @endif
    </div>

    <div class="top-right">
        <div class="search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Cari buku...">
        </div>

        <div class="notif">
            <i class="fa-regular fa-bell"></i>
        </div>

        <div class="notif">
            <i class="fa-solid fa-gear"></i>
        </div>

        <div class="avatar">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
    </div>
</div>