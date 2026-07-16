<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Perpustakaan</title>

    @vite(['src/main.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

    @include('components.sidebar-admin')

    <!-- Main Container -->
    <div class="main">

        <!-- Topbar -->
        <div class="topbar">
            <div>
                @yield('page-title')
            </div>
            <div class="top-right">
                <div class="search" style="position: relative; width: 300px;">
                    <i class="fa-solid fa-magnifying-glass"
                        style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #888;"></i>
                    <input type="text" id="menuSearch" list="systemMenus"
                        placeholder="Cari menu sistem (Dashboard, Buku...)"
                        style="padding-left: 35px; width: 100%; border: 1px solid #ddd; border-radius: 20px; height: 35px;">
                    <!-- Daftar menu sistem admin -->
                    <datalist id="systemMenus">
                        <option value="Dashboard" data-url="{{ route('admin.dashboard') }}">
                        <option value="Data Buku" data-url="{{ route('admin.books') }}">
                        <option value="Kategori Buku" data-url="{{ route('admin.categories') }}">
                        <option value="Peminjaman" data-url="{{ route('admin.loans') }}">
                        <option value="Pengembalian" data-url="{{ route('admin.returns') }}">
                        <option value="Data Member" data-url="{{ route('admin.members') }}">
                        <option value="Denda" data-url="{{ route('admin.fines') }}">
                        <option value="Laporan" data-url="{{ route('admin.reports') }}">
                    </datalist>
                </div>

                <div class="notif-wrapper" style="position: relative; display: inline-block;">
                    <div class="notif" id="notifBell" style="cursor: pointer; position: relative;">
                        <i class="fa-regular fa-bell"></i>
                        @if ($notificationCount > 0)
                            <span class="badge"
                                style="position: absolute; top: -5px; right: -5px; background: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 0.7rem; font-weight: bold;">
                                {{ $notificationCount }}
                            </span>
                        @endif
                    </div>

                    <div class="notif-dropdown" id="notifMenu"
                        style="display: none; position: absolute; right: 0; top: 35px; width: 320px; background: white; border: 1px solid #ddd; box-shadow: 0px 4px 10px rgba(0,0,0,0.1); border-radius: 8px; z-index: 1000; padding: 10px 0;">
                        <div
                            style="padding: 0 15px 10px 15px; border-bottom: 1px solid #eee; font-weight: bold; color: #333;">
                            Notifikasi Sistem
                        </div>

                        <div style="max-height: 250px; overflow-y: auto;">
                            @forelse($adminNotifications as $notif)
                                <div
                                    style="display: flex; align-items: center; padding: 10px 15px; border-bottom: 1px solid #f9f9f9; font-size: 0.85rem; color: #555;">
                                    <i class="fa-solid {{ $notif['icon'] }}"
                                        style="color: {{ $notif['color'] }}; margin-right: 12px; font-size: 1.1rem;"></i>
                                    <span>{{ $notif['message'] }}</span>
                                </div>
                            @empty
                                <div
                                    style="padding: 15px; text-align: center; color: #888; font-style: italic; font-size: 0.85rem;">
                                    Tidak ada notifikasi baru.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="notif">
                    <i class="fa-solid fa-gear"></i>
                </div>
                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </div>

        @yield('content')

    </div>

</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bell = document.getElementById('notifBell');
        const menu = document.getElementById('notifMenu');

        if (bell && menu) {
            bell.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
            });

            document.addEventListener('click', function() {
                menu.style.display = 'none';
            });
        }
    });

    document.getElementById('menuSearch').addEventListener('input', function() {
        const value = this.value;
        const options = document.querySelectorAll('#systemMenus option');
        
        options.forEach(option => {
            if (option.value.toLowerCase() === value.toLowerCase()) {
                window.location.href = option.getAttribute('data-url');
            }
        });
    });
</script>

</html>
