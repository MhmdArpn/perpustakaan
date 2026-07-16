<div class="sidebar">
    <div class="brand">
        <div class="logo">📚</div>
        <div>
            <h3>USER</h3>
            <p>Sistem Perpustakaan Online</p>
        </div>
    </div>

    <ul>
        <li class="{{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
            <a href="{{ route('member.dashboard') }}"><i class="fa-solid fa-house"></i> Dashboard</a>
        </li>
        <li class="{{ request()->routeIs('member.search') ? 'active' : '' }}">
            <a href="#"><i class="fa-solid fa-magnifying-glass"></i> Cari Buku</a>
        </li>
        <li class="{{ request()->routeIs('member.categories') ? 'active' : '' }}">
            <a href="#"><i class="fa-solid fa-layer-group"></i> Kategori</a>
        </li>
        <li class="{{ request()->routeIs('member.loans') ? 'active' : '' }}">
            <a href="#"><i class="fa-solid fa-book-open-reader"></i> Peminjaman Saya</a>
        </li>
        <li class="{{ request()->routeIs('member.history') ? 'active' : '' }}">
            <a href="#"><i class="fa-solid fa-clock-rotate-left"></i> Riwayat</a>
        </li>
        <li class="{{ request()->routeIs('member.wishlist') ? 'active' : '' }}">
            <a href="#"><i class="fa-regular fa-heart"></i> Wishlist</a>
        </li>
        <li class="{{ request()->routeIs('member.profile') ? 'active' : '' }}">
            <a href="#"><i class="fa-regular fa-user"></i> Profile</a>
        </li>
    </ul>

    <div class="logout">
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>
</div>