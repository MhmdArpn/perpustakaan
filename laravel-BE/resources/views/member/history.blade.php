@extends('layouts.layout-user')

@section('title', 'Riwayat Peminjaman')

@section('page-title')
    <h1 style="margin: 0; font-size: 1.5rem; color: #333;">Riwayat Peminjaman</h1>
    <p class="page-label" style="margin: 0; color: #777; font-size: 0.9rem;">Lihat semua histori peminjaman dan pengembalian buku</p>
@endsection

@section('content')

<!-- RINGKASAN STATISTIK (Dinamis) -->
<div class="history-overview" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-bottom: 30px;">
    <div class="history-card-summary">
        <div>
            <p>Total Dipinjam</p>
            <h3>{{ $totalBorrowed }} Buku</h3>
            <span>Semua transaksi</span>
        </div>
        <i class="fa-solid fa-book-open"></i>
    </div>
    
    <div class="history-card-summary">
        <div>
            <p>Dikembalikan</p>
            <h3>{{ $returnedCount }} Buku</h3>
            <span>{{ $totalBorrowed > 0 ? round(($returnedCount / $totalBorrowed) * 100) : 0 }}% Tingkat pengembalian</span>
        </div>
        <i class="fa-solid fa-check-circle"></i>
    </div>
    
    <div class="history-card-summary {{ $overdueCount > 0 ? 'danger-card' : '' }}">
        <div>
            <p>Terlambat</p>
            <h3>{{ $overdueCount }} Buku</h3>
            <span>{{ $overdueCount > 0 ? 'Memerlukan tindakan segera' : 'Bebas dari denda' }}</span>
        </div>
        <i class="fa-solid fa-triangle-exclamation"></i>
    </div>
</div>

<!-- FILTER & PENCARIAN LIVE -->
<div class="history-filters" style="display: flex; gap: 12px; margin-bottom: 24px; align-items: center; justify-content: space-between; flex-wrap: wrap;">
    <div class="history-search search-book large" style="flex: 1; min-width: 280px; display: flex; align-items: center; background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; gap: 12px;">
        <i class="fa-solid fa-magnifying-glass" style="color: #888;"></i>
        <input type="text" id="historySearch" placeholder="Cari judul buku atau penulis..." style="border: none; outline: none; width: 100%; font-size: 1rem; background: transparent;">
    </div>
    
    <div class="history-actions" style="display: flex; gap: 8px;">
        <select id="statusFilter" style="padding: 10px 16px; border-radius: 8px; border: 1px solid #ddd; background: #fff; font-size: 0.9rem; cursor: pointer; outline: none;">
            <option value="all">Semua Status</option>
            <option value="dikembalikan">Dikembalikan</option>
            <option value="dipinjam">Sedang Dipinjam</option>
            <option value="terlambat">Terlambat</option>
        </select>
    </div>
</div>

<!-- DAFTAR RIWAYAT -->
<div class="history-list" id="historyContainer" style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 30px;">
    @forelse($loans as $loan)
        @php
            $book = $loan->book;
            $startDate = \Carbon\Carbon::parse($loan->created_at);
            $dueDate = \Carbon\Carbon::parse($loan->due_at);
            $returnDate = $loan->returned_at ? \Carbon\Carbon::parse($loan->returned_at) : null;
            $today = \Carbon\Carbon::now();
            
            // Penentuan status & indikator warna
            if ($loan->status === 'dikembalikan') {
                $statusClass = 'dikembalikan';
                $lineColor = ''; // Default/hijau
                $badge = '<span class="badge-blue">DIKEMBALIKAN</span>';
                $metaText = '<span><i class="fa-solid fa-calendar-check"></i> Dikembalikan: ' . $returnDate->format('d M Y') . '</span>';
                $actionBtn = '<a href="#" class="btn-outline small">Detail Transaksi</a>';
            } elseif ($today->isAfter($dueDate)) {
                $statusClass = 'terlambat';
                $lineColor = 'red';
                $badge = '<span class="badge-red">TERLAMBAT</span>';
                $metaText = '<span class="text-danger"><i class="fa-solid fa-calendar-xmark"></i> Batas: ' . $dueDate->format('d M Y') . ' (Terlambat ' . $today->diffInDays($dueDate) . ' Hari)</span>';
                $actionBtn = '<a href="#" class="btn-primary small" style="background: #e74c3c;">Bayar Denda</a>';
            } else {
                $statusClass = 'dipinjam';
                $lineColor = 'blue'; // Tambahkan warna biru di CSS Anda untuk status aktif
                $badge = '<span class="badge-blue" style="background: #e3f2fd; color: #0d47a1;">DIPINJAM</span>';
                $metaText = '<span class="text-warning"><i class="fa-solid fa-calendar-day"></i> Batas: ' . $dueDate->format('d M Y') . '</span>';
                $actionBtn = '<a href="' . route('user.loans') . '" class="btn-outline small">Kelola</a>';
            }
        @endphp

        <div class="history-item" 
             data-title="{{ strtolower($book->title ?? '') }}" 
             data-author="{{ strtolower($book->author ?? '') }}"
             data-status="{{ $statusClass }}">
            
            <div class="history-line {{ $lineColor }}"></div>
            
            <div class="history-media">
                @if($book && !empty($book->cover))
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}">
                @else
                    @php $hexColor = substr(md5($book->title ?? 'Buku'), 0, 6); @endphp
                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #{{ $hexColor }}, #2c3e50); display: flex; align-items: center; justify-content: center; text-align: center; color: white; font-size: 0.7rem; font-weight: bold; padding: 4px;">
                        {{ Str::limit($book->title ?? 'Buku', 12) }}
                    </div>
                @endif
            </div>

            <div class="history-details">
                <div class="history-info">
                    <h3>{{ $book->title ?? 'Buku Telah Dihapus' }}</h3>
                    <p>Oleh: {{ $book->author ?? 'Penulis Tidak Diketahui' }}</p>
                </div>
                <div class="history-meta">
                    <span><i class="fa-solid fa-calendar-days"></i> Dipinjam: {{ $startDate->format('d M Y') }}</span>
                    {!! $metaText !!}
                </div>
            </div>

            <div class="history-status" style="display: flex; flex-direction: column; align-items: flex-end; gap: 8px;">
                {!! $badge !!}
                {!! $actionBtn !!}
            </div>
        </div>
    @empty
        <p class="no-history" style="text-align: center; color: #888; padding: 40px 0; font-style: italic; background: #fff; border-radius: 8px; border: 1px dashed #ddd;">
            Belum ada catatan riwayat aktivitas peminjaman.
        </p>
    @endforelse
</div>

<!-- PAGINATION (Laravel Native) -->
<div class="pagination-row" style="display: flex; justify-content: center; margin-top: 20px;">
    {{ $loans->links() }}
</div>

<!-- JAVASCRIPT LIVE FILTER -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('historySearch');
    const statusFilter = document.getElementById('statusFilter');
    const historyItems = document.querySelectorAll('#historyContainer .history-item');

    function filterHistory() {
        const query = searchInput.value.toLowerCase().trim();
        const selectedStatus = statusFilter.value;

        historyItems.forEach(item => {
            const title = item.getAttribute('data-title');
            const author = item.getAttribute('data-author');
            const status = item.getAttribute('data-status');

            const matchesSearch = title.includes(query) || author.includes(query);
            const matchesStatus = (selectedStatus === 'all' || status === selectedStatus);

            if (matchesSearch && matchesStatus) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    if (searchInput && statusFilter) {
        searchInput.addEventListener('input', filterHistory);
        statusFilter.addEventListener('change', filterHistory);
    }
});
</script>
@endsection