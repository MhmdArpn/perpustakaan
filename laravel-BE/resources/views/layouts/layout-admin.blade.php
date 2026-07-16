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
                <h1>@yield('page-title', 'Dashboard')</h1>
                <p>Selamat Datang Admin</p>
            </div>
            <div class="top-right">
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari data...">
                </div>
                <div class="notif">
                    <i class="fa-regular fa-bell"></i>
                </div>
                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </div>

        @yield('content')

    </div>

</body>
</html>