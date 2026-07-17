<div class="sidebar">
    <div class="brand">
        <div class="logo"><i class="fa-solid fa-book-open"></i></div>
        <div>
            <h3>{{ Auth::user()->name }}</h3>
            <p>Sistem Perpustakaan Online</p>
        </div>
    </div>

    <ul>
        <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
            <a href="{{ route('user.dashboard') }}"><i class="fa-solid fa-house"></i> Dashboard</a>
        </li>
        <li class="{{ request()->routeIs('user.cari-buku') ? 'active' : '' }}">
            <a href="{{ route('user.cari-buku') }}"><i class="fa-solid fa-magnifying-glass"></i> Cari Buku</a>
        </li>
        <li class="{{ request()->routeIs('user.kategori') ? 'active' : '' }}">
            <a href="{{ route('user.kategori') }}"><i class="fa-solid fa-layer-group"></i> Kategori</a>
        </li>
        <li class="{{ request()->routeIs('user.peminjaman') ? 'active' : '' }}">
            <a href="{{ route('user.peminjaman') }}"><i class="fa-solid fa-book-open-reader"></i> Peminjaman Saya</a>
        </li>
        <li class="{{ request()->routeIs('user.riwayat') ? 'active' : '' }}">
            <a href="{{ route('user.riwayat') }}"><i class="fa-solid fa-clock-rotate-left"></i> Riwayat</a>
        </li>
        <li class="{{ request()->routeIs('user.wishlist') ? 'active' : '' }}">
            <a href="{{ route('user.wishlist') }}"><i class="fa-regular fa-heart"></i> Wishlist</a>
        </li>
        <li class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
            <a href="{{ route('user.profile') }}"><i class="fa-regular fa-user"></i> Profile</a>
        </li>
    </ul>

    <div class="logout">
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>