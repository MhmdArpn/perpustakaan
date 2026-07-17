@extends('layouts.layout-admin')

@section('title', 'Dashboard Admin')
@section('page-title')
<h1>Dashboard</h1>
<p>Selamat Datang {{ Auth::user()->name }}</p>
@endsection

@section('content')
    <div class="cards">
        <div class="card">
            <div>
                <p>Total Buku</p>
                <h2>{{ number_format($totalBuku, 0, ',', '.') }}</h2>
            </div>
            <i class="fa-solid fa-book"></i>
        </div>
        <div class="card">
            <div>
                <p>Peminjaman</p>
                <h2>{{ number_format($totalPeminjamanAktif, 0, ',', '.') }}</h2>
            </div>
            <i class="fa-solid fa-book-open-reader"></i>
        </div>
        <div class="card">
            <div>
                <p>Member</p>
                <h2>{{ number_format($totalMember, 0, ',', '.') }}</h2>
            </div>
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="card">
            <div>
                <p>Denda</p>
                <h2>Rp{{ number_format($totalDendaBelumDibayar, 0, ',', '.') }}</h2>
            </div>
            <i class="fa-solid fa-wallet"></i>
        </div>
    </div>

    <div class="content-grid">
        <div class="activity">
            <h3>Aktivitas Terbaru</h3>

                    @forelse($recentActivities as $activity)
                        <div class="item">
                            @if ($activity->status === 'dipinjam')
                                <div class="circle blue"></div>
                            @elseif($activity->status === 'selesai')
                                <div class="circle green"></div>
                            @elseif($activity->status === 'terlambat')
                                <div class="circle orange"></div>
                            @endif

                            <p>
                                <strong>{{ $activity->user->name }}</strong>
                                @if ($activity->status === 'dipinjam')
                                    meminjam buku
                                @elseif($activity->status === 'selesai')
                                    mengembalikan buku
                                @endif
                                <em>{{ $activity->book->title }}</em>
                                <span style="font-size: 0.8rem; color: #888; margin-left: 5px;">
                                    ({{ $activity->created_at->diffForHumans() }})
                                </span>
                            </p>
                        </div>
                    @empty
                        <div class="item">
                            <p style="color: #888; font-style: italic;">Tidak ada aktivitas Terbaru.</p>
                        </div>
                    @endforelse
        </div>

        <div class="quick">
            <h3>Quick Action</h3>
            <a href="{{ route('admin.books') }}"><button>Tambah Buku</button></a>
            <a href="{{ route('admin.members') }}"><button>Tambah Member</button></a>
            <a href="{{ route('admin.reports') }}"><button>Cetak Laporan</button></a>
        </div>
    </div>
@endsection
