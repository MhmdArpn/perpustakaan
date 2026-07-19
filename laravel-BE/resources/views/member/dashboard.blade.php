@extends('layouts.layout-user')

@section('title', 'Dashboard')
@section('page-title')
    <h1 style="margin: 0; font-size: 1.5rem; color: #333;">Dashboard</h1>
@endsection

@section('content')
    <!-- Custom style tambahan khusus untuk efek gradasi foto hero dan cover generator -->
    <style>
        .hero-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .hero-image-container {
            position: relative;
            display: inline-block;
            overflow: hidden;
            border-radius: 8px;
        }

        /* Efek gradasi yang menutupi foto agar menyatu halus ke arah kiri (arah teks) */
        .hero-image-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
            pointer-events: none;
        }

        /* CSS Cover Generator untuk buku yang tidak memiliki gambar di database */
        .book-cover-placeholder {
            width: 100%;
            height: 250px;
            /* Menyesuaikan dengan tinggi standar card img Anda */
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 15px;
            text-align: center;
            color: white;
            font-weight: bold;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
            margin-bottom: 12px;
            position: relative;
            overflow: hidden;
        }

        .book-cover-placeholder::after {
            content: "📖";
            font-size: 2.5rem;
            opacity: 0.15;
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        .book-cover-text {
            font-size: 1rem;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .book-cover-author {
            font-size: 0.75rem;
            font-weight: normal;
            opacity: 0.8;
            margin-top: 5px;
        }
    </style>

    <!-- HERO -->
    <div class="hero-card">
        <div class="hero-content">
            <h1>Halo 👋 Selamat Datang, {{ Auth::user()->name }}</h1>
            <p>
                Selamat datang di Sistem Perpustakaan Online.
                Temukan berbagai koleksi buku digital terbaru hari ini.
            </p>
            <button onclick="document.getElementById('menuSearch').focus()"
                style="padding: 10px 20px; font-size: 1rem; border: none; background-color: #008cff; color: white; border-radius: 5px; cursor: pointer;">
                Mulai Jelajah
            </button>
        </div>

        <div class="hero-image">
            <div class="hero-image-container">
                <img src="https://picsum.photos/250/180" alt="Hero Image" style="display: block; width: 100%; height: auto;">
            </div>
        </div>
    </div>

    <!-- KATEGORI POPULER (Dinamis dari Database) -->
    <div class="section-title">
        <h2>Kategori Populer</h2>
        <a href="{{ route('user.kategori') }}">Lihat Semua</a>
    </div>

    <div class="categories">
        @php
            // Daftar class warna bawaan dari stylesheet Anda
            $themeColors = ['blue', 'yellow', 'green', 'purple', 'orange'];
        @endphp

        @forelse($categories as $index => $category)
            <div class="category-card {{ $themeColors[$index % count($themeColors)] }}">
                {{ $category->name }}
            </div>
        @empty
            <div class="category-card blue">
                Umum
            </div>
        @endforelse
    </div>

    <!-- BUKU (Dinamis dari Database & Fallback Cover Generator) -->
    <div class="section-title">
        <h2>Buku Terpopuler</h2>
    </div>

    <div class="books">
        @forelse($popularBooks as $book)
            <div class="book-card">
                @if (!empty($book->cover_url))
                    <!-- Jika suatu saat ada kolom cover_url -->
                    <img src="{{ $book->cover_url }}" alt="{{ $book->title }}">
                @elseif(!empty($book->cover))
                    <!-- Jika menggunakan penyimpanan file lokal Laravel -->
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}">
                @else
                    <!-- Generator Cover Bergradasi Otomatis (Warna dihitung unik berdasarkan judul buku) -->
                    @php
                        $hexColor = substr(md5($book->title), 0, 6);
                    @endphp
                    <div class="book-cover-placeholder"
                        style="background: linear-gradient(135deg, #{{ $hexColor }}, #2c3e50);">
                        <div class="book-cover-text">{{ $book->title }}</div>
                        <div class="book-cover-author">Oleh: {{ $book->author ?? 'Anonim' }}</div>
                    </div>
                @endif

                <h3>{{ $book->title }}</h3>
                <p>{{ $book->author ?? 'Penulis Tidak Diketahui' }}</p>

                @if (($book->available_copies ?? 0) > 0)
                    <!-- Form untuk mengirimkan request peminjaman secara aman -->
                    <form action="{{ route('user.pinjam', $book->id) }}" method="POST"
                        style="display: inline; width: 100%;">
                        @csrf
                        <button type="submit" style="width: 100%;">
                            Pinjam
                        </button>
                    </form>
                @else
                    <button type="button" disabled style="background: #ccc; cursor: not-allowed; width: 100%;">
                        Habis
                    </button>
                @endif
            </div>
        @empty
            <p style="grid-column: 1/-1; text-align: center; color: #888; font-style: italic; padding: 20px 0;">
                Tidak ada koleksi buku yang tersedia saat ini.
            </p>
        @endforelse
    </div>

    <!-- RIWAYAT PEMINJAMAN (Dinamis dari Database) -->
    <div class="table-card">
        <div class="table-header">
            <h3>Riwayat Peminjaman</h3>
            <a href="{{ route('user.laporan') }}" class="btn-laporan" style="text-decoration: none;">
                <button style="cursor: pointer;">
                    <i class="fa-solid fa-download"></i>
                    Laporan
                </button>
            </a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Deadline</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowLogs as $log)
                    <tr>
                        <td><strong>{{ $log->book->title ?? 'Buku Telah Dihapus' }}</strong></td>
                        <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($log->due_at)->format('d M Y') }}</td>
                        <td>
                            @if ($log->status == 'dipinjam')
                                @if (\Carbon\Carbon::parse($log->due_at)->isPast())
                                    <span class="badge danger">Terlambat</span>
                                @else
                                    <span class="badge info">Dipinjam</span>
                                @endif
                            @elseif($log->checkFine == 'unpaid')
                                <span class="badge warning">Dikembalikan | Denda Belum Dibayar</span>
                            @elseif($log->checkFine == 'paid')
                                <span class="badge success">Dikembalikan</span>
                            @else
                                <span class="badge danger">Terlambat</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; color: #888; padding: 20px 0;">
                            Kamu belum memiliki riwayat peminjaman buku.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
