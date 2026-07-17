@extends('layouts.layout-user')

@section('title', 'Laporan & Riwayat')

@section('page-title')
    <h1 style="margin: 0; font-size: 1.5rem; color: #333;">Laporan Aktivitas</h1>
@endsection

@section('content')
<!-- NOTIFIKASI -->
@if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #28a745;">
         <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div style="background-color: #f8d7da; color: #721c24; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #dc3545;">
         <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
    </div>
@endif

<div class="page-header" style="margin-bottom: 24px;">
    <div>
        <h1 style="margin: 0; font-size: 1.8rem;">Riwayat & Laporan Peminjaman</h1>
        <p style="margin: 4px 0 0 0; color: #777;">Pantau buku yang sedang dipinjam, batas kembali, dan riwayat pengembalian Anda.</p>
    </div>
</div>

<!-- STATS REPORT -->
<div class="cards" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-bottom: 24px;">
    <div class="card" style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #eee;">
        <p style="margin:0; color:#777; font-size:0.85rem;">TOTAL SEMUA TRANSAKSI</p>
        <h2 style="margin:8px 0 0 0; color:#2c3e50;">{{ $totalBorrowed }} Buku</h2>
    </div>
    <div class="card" style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #eee;">
        <p style="margin:0; color:#777; font-size:0.85rem;">SEDANG DIPINJAM</p>
        <h2 style="margin:8px 0 0 0; color:#3498db;">{{ $activeLoanCount }} Buku</h2>
    </div>
    <div class="card" style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #eee;">
        <p style="margin:0; color:#777; font-size:0.85rem;">TRANSAKSI TERLAMBAT</p>
        <h2 style="margin:8px 0 0 0; color:#e74c3c;">{{ $overdueCount }} Transaksi</h2>
    </div>
</div>

<!-- FILTER STATUS -->
<div class="filter-bar" style="background: #fff; padding: 16px; border-radius: 8px; border: 1px solid #eee; margin-bottom: 20px; display: flex; gap: 12px; align-items: center;">
    <span style="font-weight: bold; color: #555;"><i class="fa-solid fa-filter"></i> Filter Status:</span>
    <form action="{{ route('user.reports') }}" method="GET" id="filterForm" style="display: flex; gap: 10px;">
        <select name="status" onchange="document.getElementById('filterForm').submit()" style="padding: 8px 12px; border-radius: 6px; border: 1px solid #ddd; outline: none; cursor: pointer;">
            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Riwayat</option>
            <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Sedang Dipinjam</option>
            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai (Sudah Kembali)</option>
            <option value="terlambat" {{ request('status') == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
        </select>
    </form>
</div>

<!-- TABEL LAPORAN -->
<div class="card" style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #eee; overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 2px solid #eee; color: #555; font-weight: bold;">
                <th style="padding: 12px 8px;">Buku</th>
                <th style="padding: 12px 8px;">Tanggal Pinjam</th>
                <th style="padding: 12px 8px;">Batas Kembali</th>
                <th style="padding: 12px 8px;">Tanggal Pengembalian</th>
                <th style="padding: 12px 8px;">Status</th>
                <th style="padding: 12px 8px;">Catatan</th>
                <th style="padding: 12px 8px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $loan)
                <tr style="border-bottom: 1px solid #f9f9f9; transition: 0.2s;">
                    <td style="padding: 16px 8px; display: flex; align-items: center; gap: 12px;">
                        @if($loan->book->cover)
                            <img src="{{ asset('storage/' . $loan->book->cover) }}" style="width: 45px; height: 60px; object-fit: cover; border-radius: 4px;">
                        @else
                            <div style="width: 45px; height: 60px; background: #eee; border-radius: 4px; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; text-align: center; font-weight: bold; color: #777;">No Cover</div>
                        @endif
                        <div>
                            <strong style="display: block; color: #2c3e50;">{{ $loan->book->title }}</strong>
                            <small style="color: #999;">{{ $loan->book->author }}</small>
                        </div>
                    </td>
                    <td style="padding: 16px 8px; color: #555;">{{ $loan->loaned_at->translatedFormat('d M Y') }}</td>
                    <td style="padding: 16px 8px; color: #555;">{{ $loan->due_at->translatedFormat('d M Y') }}</td>
                    <td style="padding: 16px 8px; color: #555;">
                        {{ $loan->returned_at ? $loan->returned_at->translatedFormat('d M Y') : '-' }}
                    </td>
                    <td style="padding: 16px 8px;">
                        @if($loan->status == 'dipinjam')
                            @if(Carbon\Carbon::now()->gt($loan->due_at))
                                <span style="background: #ffe0e0; color: #e74c3c; padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: bold;">TERLAMBAT</span>
                            @else
                                <span style="background: #dff9fb; color: #0984e3; padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: bold;">DIPINJAM</span>
                            @endif
                        @elseif($loan->status == 'selesai')
                            <span style="background: #e3fcef; color: #00b894; padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: bold;">SELESAI</span>
                        @elseif($loan->status == 'terlambat')
                            <span style="background: #ffe0e0; color: #e74c3c; padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: bold;">TERLAMBAT (KEMBALI)</span>
                        @endif
                    </td>
                    <td style="padding: 16px 8px; font-size: 0.85rem; color: #666;">
                        {{ $loan->notes ?? '-' }}
                    </td>
                    <td style="padding: 16px 8px; text-align: center;">
                        @if($loan->status == 'dipinjam')
                            <form action="{{ route('user.loans.return', $loan->id) }}" method="POST" onsubmit="return confirm('Kembalikan buku sekarang?')">
                                @csrf
                                <button type="submit" style="background: #00b894; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 0.8rem; font-weight: bold; transition: 0.2s;">Kembalikan</button>
                            </form>
                        @else
                            <span style="color: #bbb; font-size: 0.85rem;"><i class="fa-solid fa-circle-check"></i> Selesai</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #888; padding: 40px 0;">
                        Tidak ada riwayat transaksi peminjaman yang ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection