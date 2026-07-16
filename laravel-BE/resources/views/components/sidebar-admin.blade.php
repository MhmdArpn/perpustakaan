<div class="sidebar">
    <div class="brand">
        <div class="logo">📚</div>
        <div>
            <h3>{{ Auth::user()->name }}</h3>
            <p>Sistem Perpustakaan Online</p>
        </div>
    </div>

    <ul>
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-house"></i>Dashboard</a>
        </li>
        <li class="{{ request()->routeIs('admin.books') ? 'active' : '' }}">
            <a href="{{ route('admin.books') }}"><i class="fa-solid fa-book"></i>Data Buku</a>
        </li>
        <li class="{{ request()->routeIs('admin.categories') ? 'active' : '' }}">
            <a href="{{ route('admin.categories') }}"><i class="fa-solid fa-tags"></i>Kategori</a>
        </li>
        <li class="{{ request()->routeIs('admin.loans') ? 'active' : '' }}">
            <a href="{{ route('admin.loans') }}"><i class="fa-solid fa-book-open-reader"></i>Peminjaman</a>
        </li>
        <li class="{{ request()->routeIs('admin.returns') ? 'active' : '' }}">
            <a href="{{ route('admin.returns') }}"><i class="fa-solid fa-undo"></i>Pengembalian</a>
        </li>
        <li class="{{ request()->routeIs('admin.members') ? 'active' : '' }}">
            <a href="{{ route('admin.members') }}"><i class="fa-solid fa-users"></i>Member</a>
        </li>
        <li class="{{ request()->routeIs('admin.fines') ? 'active' : '' }}">
            <a href="{{ route('admin.fines') }}"><i class="fa-solid fa-money-bill"></i>Denda</a>
        </li>
        <li class="{{ request()->routeIs('admin.reports') ? 'active' : '' }}">
            <a href="{{ route('admin.reports') }}"><i class="fa-solid fa-file-alt"></i>Laporan</a>
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