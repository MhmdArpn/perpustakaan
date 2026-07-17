@extends('layouts.layout-user')

@section('title', 'Peminjaman Saya')

@section('page-title')
    <h1 style="margin: 0; font-size: 1.5rem; color: #333;">Peminjaman Saya</h1>
    <p class="page-label" style="margin: 0; color: #777; font-size: 0.9rem;">Kelola dan pantau status peminjaman buku kamu secara real-time.</p>
@endsection

@section('content')

<!-- CARDS INFORMASI STATUS -->
<div class="status-cards" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-bottom: 30px;">
    <div class="status-card light-blue">
        <div>
            <p class="status-label">Sedang Dipinjam</p>
            <h3>{{ $borrowingCount }} Buku</h3>
        </div>
        <i class="fa-solid fa-book-open"></i>
    </div>
    <div class="status-card light-yellow">
        <div>
            <p class="status-label">Sudah Dikembalikan</p>
            <h3>{{ $returnedCount }} Buku</h3>
        </div>
        <i class="fa-solid fa-check-circle"></i>
    </div>
    <div class="status-card light-red">
        <div>
            <p class="status-label">Terlambat</p>
            <h3>{{ $overdueCount }} Buku</h3>
        </div>
        <i class="fa-solid fa-triangle-exclamation"></i>
    </div>
</div>

<!-- CONTROL PENCARIAN & FILTER -->
<div class="loan-controls" style="display: flex; gap: 12px; margin-bottom: 24px; align-items: center; justify-content: space-between; flex-wrap: wrap;">
    <div class="search-book large" style="flex: 1; min-width: 280px; display: flex; align-items: center; background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; gap: 12px;">
        <i class="fa-solid fa-magnifying-glass" style="color: #888;"></i>
        <input type="text" id="loanSearch" placeholder="Cari berdasarkan judul atau penulis..." style="border: none; outline: none; width: 100%; font-size: 1rem; background: transparent;">
    </div>
    <div class="loan-filters" style="display: flex; gap: 8px;">
        <select id="statusFilter" style="padding: 10px 16px; border-radius: 8px; border: 1px solid #ddd; background: #fff; font-size: 0.9rem; cursor: pointer; outline: none;">
            <option value="all">Semua Status</option>
            <option value="aktif">Sedang Dipinjam</option>
            <option value="terlambat">Terlambat</option>
        </select>
    </div>
</div>

<!-- DAFTAR PEMINJAMAN AKTIF -->
<div class="loan-list" id="loanContainer" style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 40px;">
    @forelse($activeLoans as $loan)
        @php
            $book = $loan->book;
            $startDate = \Carbon\Carbon::parse($loan->created_at);
            $dueDate = \Carbon\Carbon::parse($loan->due_at);
            $today = \Carbon\Carbon::now();
            
            // Hitung sisa hari & progress peminjaman
            $totalDuration = $startDate->diffInDays($dueDate) ?: 1;
            $elapsedDays = $startDate->diffInDays($today);
            $progressPercent = min(100, round(($elapsedDays / $totalDuration) * 100));
            
            $isOverdue = $today->isAfter($dueDate);
            $remainingDays = $today->diffInDays($dueDate, false);
        @endphp

        <div class="loan-card {{ $isOverdue ? 'loan-danger' : 'loan-primary' }}" 
             data-title="{{ strtolower($book->title ?? '') }}" 
             data-author="{{ strtolower($book->author ?? '') }}"
             data-status="{{ $isOverdue ? 'terlambat' : 'aktif' }}">
            
            <div class="loan-cover">
                @if(!empty($book->cover))
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title ?? 'Buku' }}">
                @else
                    @php $hexColor = substr(md5($book->title ?? 'Buku'), 0, 6); @endphp
                    <div style="width: 100%; height: 100%; border-radius: 6px; background: linear-gradient(135deg, #{{ $hexColor }}, #2c3e50); display: flex; align-items: center; justify-content: center; text-align: center; color: white; font-size: 0.75rem; font-weight: bold; padding: 4px;">
                        {{ $book->title ?? 'Buku' }}
                    </div>
                @endif
            </div>

            <div class="loan-content" style="flex: 1;">
                <h3>{{ $book->title ?? 'Buku Telah Dihapus' }}</h3>
                <p>Oleh {{ $book->author ?? 'Penulis Tidak Diketahui' }}</p>
                
                <div class="loan-progress {{ $isOverdue ? 'danger' : '' }}">
                    @if($isOverdue)
                        <span class="loan-status danger-text">TERLAMBAT {{ abs($remainingDays) }} HARI</span>
                        <div class="progress-bar danger">
                            <div class="progress-fill" style="width: 100%;"></div>
                        </div>
                        <span class="loan-days">100%</span>
                    @else
                        <span class="loan-status">SISA {{ $remainingDays }} HARI</span>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $progressPercent }}%;"></div>
                        </div>
                        <span class="loan-days">{{ $progressPercent }}%</span>
                    @endif
                </div>

                <div class="loan-dates">
                    <span>Pinjam: {{ $startDate->format('d M') }}</span>
                    <span>Kembali: {{ $dueDate->format('d M') }}</span>
                </div>
            </div>

            <div class="loan-action" style="display: flex; flex-direction: column; align-items: flex-end; justify-content: space-between; gap: 12px;">
                @if($isOverdue)
                    <span class="badge-red">TERLAMBAT</span>
                @else
                    <span class="badge-blue">DIPINJAM</span>
                @endif
                
                <!-- Form Perpanjangan Buku -->
                <form action="{{ route('user.loans.extend', $loan->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin memperpanjang peminjaman buku ini?')">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn-primary small" {{ $isOverdue ? 'disabled style=background:#ccc;cursor:not-allowed;' : '' }}>
                        Perpanjang
                    </button>
                </form>
            </div>
        </div>
    @empty
        <p class="no-loans" style="text-align: center; color: #888; padding: 30px 0; font-style: italic; background: #fff; border-radius: 8px; border: 1px dashed #ccc;">
            Saat ini kamu tidak memiliki peminjaman aktif.
        </p>
    @endforelse
</div>

<!-- SEPARATOR RIWAYAT TERBARU -->
<div class="section-footer" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h3>Riwayat Terbaru (Sudah Dikembalikan)</h3>
    <a href="{{ route('user.dashboard') }}" class="btn-outline" style="text-decoration: none;">Ke Dashboard</a>
</div>

<!-- BARIS RIWAYAT TERBARU -->
<div class="history-row" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 16px;">
    @forelse($returnedHistory as $history)
        @php $hBook = $history->book; @endphp
        <div class="history-card" style="display: flex; gap: 12px; background: #fff; padding: 12px; border-radius: 8px; border: 1px solid #eee; align-items: center;">
            <div style="width: 50px; height: 70px; flex-shrink: 0; border-radius: 4px; overflow: hidden; background: #f0f0f0;">
                @if($hBook && !empty($hBook->cover))
                    <img src="{{ asset('storage/' . $hBook->cover) }}" alt="{{ $hBook->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    @php $hColor = substr(md5($hBook->title ?? 'Buku'), 0, 6); @endphp
                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #{{ $hColor }}, #2c3e50); display: flex; align-items: center; justify-content: center; text-align: center; color: white; font-size: 0.6rem; font-weight: bold; padding: 2px;">
                        {{ Str::limit($hBook->title ?? 'Buku', 10) }}
                    </div>
                @endif
            </div>
            <div>
                <strong style="display: block; font-size: 0.95rem; color: #333; margin-bottom: 4px;">{{ $hBook->title ?? 'Buku Dihapus' }}</strong>
                <span style="font-size: 0.8rem; color: #777;">Dikembalikan {{ \Carbon\Carbon::parse($history->updated_at)->format('d M Y') }}</span>
            </div>
        </div>
    @empty
        <p style="color: #888; font-style: italic; font-size: 0.9rem;">Belum ada riwayat pengembalian.</p>
    @endforelse
</div>

<!-- JAVASCRIPT LIVE FILTER -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const loanSearch = document.getElementById('loanSearch');
    const statusFilter = document.getElementById('statusFilter');
    const loanCards = document.querySelectorAll('#loanContainer .loan-card');

    function filterLoans() {
        const query = loanSearch.value.toLowerCase().trim();
        const selectedStatus = statusFilter.value;

        loanCards.forEach(card => {
            const title = card.getAttribute('data-title');
            const author = card.getAttribute('data-author');
            const status = card.getAttribute('data-status');

            const matchesSearch = title.includes(query) || author.includes(query);
            const matchesStatus = (selectedStatus === 'all' || status === selectedStatus);

            if (matchesSearch && matchesStatus) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    if (loanSearch && statusFilter) {
        loanSearch.addEventListener('input', filterLoans);
        statusFilter.addEventListener('change', filterLoans);
    }
});
</script>
@endsection