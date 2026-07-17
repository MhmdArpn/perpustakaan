@extends('layouts.layout-user')

@section('title', 'Profile Saya')

@section('page-title')
    <h1 style="margin: 0; font-size: 1.5rem; color: #333;">Profile Saya</h1>
            <p class="page-sub-label" style="margin: 4px 0 0 0; color: #777;">Kelola informasi akun dan aktivitas perpustakaan</p>
@endsection

@section('content')
<!-- NOTIFIKASI SUKSES / ERROR -->
@if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #28a745;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div style="background-color: #f8d7da; color: #721c24; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #dc3545;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- FORM PROFILE UTAMA (TERINTEGRASI EDIT FOTO & DATA) -->
<form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="profile-card card" style="background: #fff; padding: 24px; border-radius: 8px; border: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <div class="profile-left" style="display: flex; align-items: center; gap: 20px;">
            <div class="profile-avatar" style="position: relative;">
                @if(Auth::user()->avatar)
                    <img id="avatarPreview" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="avatar" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid #3498db;">
                @else
                    <img id="avatarPreview" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3498db&color=fff" alt="avatar" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                @endif
                
                <!-- Label Tombol Upload Mini -->
                <label for="avatarInput" style="position: absolute; bottom: 0; right: 0; background: #3498db; color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.2); transition: 0.2s;">
                    <i class="fa-solid fa-camera" style="font-size: 0.85rem;"></i>
                </label>
                <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display: none;">
            </div>
            <div class="profile-info">
                <h2 style="margin: 0; font-size: 1.5rem; color: #2c3e50;">{{ Auth::user()->name }}</h2>
                <p class="muted" style="margin: 4px 0; color: #777;">{{ Auth::user()->email }}</p>
                <p class="muted small" style="margin: 0; color: #999; font-size: 0.85rem;">Bergabung sejak {{ Auth::user()->created_at->format('M Y') }}</p>
            </div>
        </div>
        <div class="profile-actions">
            <button type="submit" class="btn-primary" style="padding: 10px 24px; border-radius: 6px; font-weight: bold; cursor: pointer;">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
            </button>
        </div>
    </div>

    <!-- CARDS STATISTIK DINAMIS -->
    <div class="cards" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-top: 18px; margin-bottom: 24px;">
        <div class="card small-card" style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #eee; text-align: center;">
            <p style="margin: 0; color: #777; font-size: 0.85rem; font-weight: bold;">TOTAL DIBACA</p>
            <h3 style="margin: 8px 0 0 0; font-size: 1.8rem; color: #2c3e50;">{{ $totalReadCount }}</h3>
        </div>
        <div class="card small-card" style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #eee; text-align: center;">
            <p style="margin: 0; color: #777; font-size: 0.85rem; font-weight: bold;">SEDANG PINJAM</p>
            <h3 style="margin: 8px 0 0 0; font-size: 1.8rem; color: #e67e22;">{{ $activeLoanCount }}</h3>
        </div>
        <div class="card small-card" style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #eee; text-align: center;">
            <p style="margin: 0; color: #777; font-size: 0.85rem; font-weight: bold;">WISHLIST</p>
            <h3 style="margin: 8px 0 0 0; font-size: 1.8rem; color: #3498db;">{{ $wishlistCount }}</h3>
        </div>
        <div class="card small-card" style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #eee; text-align: center;">
            <p style="margin: 0; color: #777; font-size: 0.85rem; font-weight: bold;">TERLAMBAT</p>
            <h3 style="margin: 8px 0 0 0; font-size: 1.8rem; color: #e74c3c;">{{ $overdueCount }}</h3>
        </div>
    </div>

    <!-- GRID INFORMASI PRIBADI & PENGATURAN -->
    <div class="grid-2" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 18px;">
        <div class="card form-card" style="background: #fff; padding: 24px; border-radius: 8px; border: 1px solid #eee;">
            <h3 style="margin-top: 0; margin-bottom: 18px; font-size: 1.2rem; color: #2c3e50;">Informasi Pribadi</h3>
            <div class="info-grid" style="display: flex; flex-direction: column; gap: 16px;">
                <div class="input-field">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #555;">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; outline: none; transition: 0.2s;">
                </div>
                <div class="input-field">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #555;">Email</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; outline: none; background-color: #fcfcfc;">
                </div>
                <div class="input-field">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #555;">Nomor HP</label>
                    <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}" placeholder="Contoh: 08123456789" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; outline: none;">
                </div>
                <div class="input-field">
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #555;">Alamat</label>
                    <textarea name="address" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; outline: none; font-family: inherit;">{{ old('address', Auth::user()->address ?? '') }}</textarea>
                </div>
            </div>
            <div class="note" style="margin-top: 16px; background: #f8f9fa; padding: 12px; border-radius: 6px; font-size: 0.8rem; color: #666; border-left: 3px solid #3498db;">
                Data ini digunakan untuk keperluan verifikasi transaksi peminjaman buku fisik dan notifikasi keterlambatan pengembalian.
            </div>
        </div>
</form>

        <!-- KARTU PENGATURAN -->
        <div class="card settings-card" style="background: #fff; padding: 24px; border-radius: 8px; border: 1px solid #eee;">
            <h3 style="margin-top: 0; margin-bottom: 18px; font-size: 1.2rem; color: #2c3e50;">Pengaturan Akun</h3>
            <ul class="settings-list" style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px;">
                <li onclick="openPasswordModal()" style="padding: 14px; border-radius: 6px; border: 1px solid #f1f1f1; display: flex; justify-content: space-between; align-items: center; cursor: pointer; transition: 0.2s;">
                    <span><i class="fa-solid fa-lock" style="width: 24px; color: #7f8c8d;"></i> Ubah Password</span>
                    <span class="muted small" style="color: #bbb;">&gt;</span>
                </li>
                <li class="toggle-row" style="padding: 14px; border-radius: 6px; border: 1px solid #f1f1f1; display: flex; justify-content: space-between; align-items: center;">
                    <span><i class="fa-solid fa-moon" style="width: 24px; color: #7f8c8d;"></i> Dark Mode</span>
                    <label class="switch" style="position: relative; display: inline-block; width: 44px; height: 22px;">
                        <input type="checkbox" id="darkModeToggle" style="opacity: 0; width: 0; height: 0;">
                        <span class="slider" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ccc; transition: .4s; border-radius: 34px;"></span>
                    </label>
                </li>
                <li style="padding: 14px; border-radius: 6px; border: 1px solid #f1f1f1; display: flex; justify-content: space-between; align-items: center;">
                    <span><i class="fa-solid fa-bell" style="width: 24px; color: #7f8c8d;"></i> Notifikasi</span>
                    <span class="badge" style="background: #2ecc71; color: #fff; font-size: 0.75rem; padding: 2px 8px; border-radius: 12px;">Aktif</span>
                </li>
                <li onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="padding: 14px; border-radius: 6px; border: 1px solid #fce4e4; background: #fff5f5; color: #e74c3c; display: flex; justify-content: space-between; align-items: center; cursor: pointer; transition: 0.2s;">
                    <span><i class="fa-solid fa-sign-out-alt" style="width: 24px;"></i> Keluar dari Akun</span>
                    <span class="muted small" style="color: #f5b0b0;">&gt;</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- FORM KELUAR (LOGOUT) -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<!-- MODAL UBAH PASSWORD -->
<div id="passwordModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center; padding: 15px;">
    <div style="background: white; padding: 24px; border-radius: 8px; width: 100%; max-width: 450px; box-shadow: 0 4px 15px rgba(0,0,0,0.2); position: relative;">
        <h3 style="margin-top: 0; margin-bottom: 18px; color: #2c3e50;">Ubah Password</h3>
        <form action="{{ route('user.profile.update-password') }}" method="POST">
            @csrf
            @method('PUT')
            <div style="display: flex; flex-direction: column; gap: 14px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #555;">Password Saat Ini</label>
                    <input type="password" name="current_password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #555;">Password Baru</label>
                    <input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #555;">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
                </div>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closePasswordModal()" style="padding: 10px 18px; border-radius: 6px; border: 1px solid #ccc; background: #eee; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 18px; border-radius: 6px; background: #3498db; color: white; border: none; cursor: pointer; font-weight: 600;">Simpan Password</button>
            </div>
        </form>
    </div>
</div>

<!-- JAVASCRIPT LOGIKAL -->
<script>
    // Preview gambar instan ketika user memilih file
    document.getElementById('avatarInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Kendali Modal Ubah Password
    function openPasswordModal() {
        document.getElementById('passwordModal').style.display = 'flex';
    }

    function closePasswordModal() {
        document.getElementById('passwordModal').style.display = 'none';
    }

    // Toggle Dark Mode Sederhana
    const darkModeToggle = document.getElementById('darkModeToggle');
    darkModeToggle.addEventListener('change', function() {
        if (this.checked) {
            document.body.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
        }
    });

    // Cek preferensi tema saat load halaman
    if (localStorage.getItem('theme') === 'dark') {
        darkModeToggle.checked = true;
        document.body.classList.add('dark-mode');
    }
</script>

<style>
    /* Transisi sederhana saat hovering menu list */
    .settings-list li:hover {
        background-color: #fbfbfb;
        transform: translateX(3px);
    }
    /* Estetika Toggle Slider */
    .switch input:checked + .slider {
        background-color: #3498db;
    }
    .switch input:focus + .slider {
        box-shadow: 0 0 1px #3498db;
    }
    .switch .slider:before {
        position: absolute;
        content: "";
        height: 14px;
        width: 14px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }
    .switch input:checked + .slider:before {
        transform: translateX(22px);
    }
</style>
@endsection