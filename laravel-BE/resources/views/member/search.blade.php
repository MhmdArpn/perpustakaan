@extends('layouts.layout-user')

@section('title', 'Cari Buku')

@section('page-title')
    <h1 style="margin: 0; font-size: 1.5rem; color: #333;">Cari Buku</h1>
@endsection

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <p class="page-label" style="margin: 0; color: #777; font-size: 0.9rem;">Cari Buku</p>
        <h1 style="margin: 4px 0 0 0; font-size: 1.8rem;">Temukan koleksi buku yang kamu cari</h1>
    </div>
    <a href="{{ route('user.dashboard') }}" class="btn-outline" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali
    </a>
</div>

<!-- PANEL PENCARIAN -->
<div class="search-panel" style="display: flex; gap: 12px; margin-bottom: 24px; align-items: center; width: 100%;">
    <!-- Input pencarian mengambil sisa ruang maksimal -->
    <div class="search-book large" style="flex: 1; display: flex; align-items: center; background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 14px 18px; gap: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <i class="fa-solid fa-magnifying-glass" style="color: #888; font-size: 1.1rem;"></i>
        <input type="text" id="searchInput" placeholder="Cari judul buku atau penulis..." style="border: none; outline: none; width: 100%; font-size: 1.05rem; background: transparent;">
    </div>
    
    <!-- Tombol pencarian minimalis (Icon Only) berbentuk kotak presisi -->
    <button class="btn-primary" id="searchBtn" style="width: 50px; height: 50px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; flex-shrink: 0;" title="Cari">
        <i class="fa-solid fa-search" style="font-size: 1.1rem;"></i>
    </button>
</div>

<!-- BAR FILTER MODERN -->
<div class="filter-bar modern-filter" style="display: flex; gap: 12px; margin-bottom: 30px; flex-wrap: wrap;">
    <select id="filterCategory" style="padding: 10px 16px; border-radius: 8px; border: 1px solid #ddd; background: #fff; font-size: 0.9rem; cursor: pointer; outline: none;">
        <option value="all">Semua Kategori</option>
        @foreach($categories as $category)
            <option value="{{ Str::slug($category->name) }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <select id="filterStatus" style="padding: 10px 16px; border-radius: 8px; border: 1px solid #ddd; background: #fff; font-size: 0.9rem; cursor: pointer; outline: none;">
        <option value="all">Semua Status</option>
        <option value="tersedia">Tersedia</option>
        <option value="dipinjam">Dipinjam / Habis</option>
    </select>

    <select id="filterSort" style="padding: 10px 16px; border-radius: 8px; border: 1px solid #ddd; background: #fff; font-size: 0.9rem; cursor: pointer; outline: none;">
        <option value="default">Urutkan</option>
        <option value="az">A-Z (Judul)</option>
        <option value="za">Z-A (Judul)</option>
    </select>

    <button class="btn-outline secondary" id="resetFilters" style="display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-rotate-right"></i>
        Reset
    </button>
</div>

<!-- JUDUL HASIL PENCARIAN -->
<div class="section-title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Hasil Pencarian</h2>
    <span class="result-count" id="resultCount" style="color: #666; font-weight: 500;">{{ $books->count() }} buku tersedia</span>
</div>

<!-- DAFTAR BUKU -->
<div class="books" id="booksGrid">
    @forelse($books as $book)
        @php
            $isAvailable = ($book->qty ?? 1) > 0;
            $bookCategorySlug = isset($book->category) ? Str::slug($book->category->name) : 'umum';
            $bookStatus = $isAvailable ? 'tersedia' : 'dipinjam';
        @endphp
        
        <div class="book-card" 
             data-title="{{ strtolower($book->title) }}" 
             data-author="{{ strtolower($book->author ?? '') }}" 
             data-category="{{ $bookCategorySlug }}" 
             data-status="{{ $bookStatus }}">
            
            @if(!empty($book->cover))
                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}">
            @else
                <!-- Generator Cover Bergradasi jika cover kosong -->
                @php $hexColor = substr(md5($book->title), 0, 6); @endphp
                <div style="width: 100%; height: 250px; border-radius: 8px; background: linear-gradient(135deg, #{{ $hexColor }}, #2c3e50); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 15px; text-align: center; color: white; margin-bottom: 12px; font-weight: bold;">
                    <span style="font-size: 0.95rem;">{{ $book->title }}</span>
                    <span style="font-size: 0.75rem; font-weight: normal; opacity: 0.8; margin-top: 5px;">{{ $book->author ?? 'Anonim' }}</span>
                </div>
            @endif

            <h3>{{ $book->title }}</h3>
            <p>{{ $book->author ?? 'Penulis Tidak Diketahui' }}</p>
            
            <div class="book-meta" style="display: flex; gap: 6px; margin: 8px 0 12px 0; flex-wrap: wrap;">
                <span class="badge-blue" style="font-size: 0.75rem; padding: 4px 8px; border-radius: 4px; background: #e0f2fe; color: #0369a1;">
                    {{ $book->category->name ?? 'Umum' }}
                </span>
                @if($isAvailable)
                    <span class="badge-green" style="font-size: 0.75rem; padding: 4px 8px; border-radius: 4px; background: #dcfce7; color: #15803d;">Tersedia</span>
                @else
                    <span class="badge-red" style="font-size: 0.75rem; padding: 4px 8px; border-radius: 4px; background: #fee2e2; color: #b91c1c;">Dipinjam</span>
                @endif
            </div>
            
            <button {{ !$isAvailable ? 'disabled' : '' }}>
                {{ $isAvailable ? 'Pinjam' : 'Dipinjam' }}
            </button>
        </div>
    @empty
        <p class="no-results" style="grid-column: 1/-1; text-align: center; color: #888; padding: 40px 0;">
            Koleksi buku belum tersedia di database.
        </p>
    @endforelse
</div>

<!-- JAVASCRIPT FILTERING & SORTING INSTAN -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    const filterCategory = document.getElementById('filterCategory');
    const filterStatus = document.getElementById('filterStatus');
    const filterSort = document.getElementById('filterSort');
    const resetFilters = document.getElementById('resetFilters');
    const booksGrid = document.getElementById('booksGrid');
    const resultCount = document.getElementById('resultCount');
    
    // Simpan list elemen asli untuk sorting
    const originalBooks = Array.from(booksGrid.getElementsByClassName('book-card'));

    function filterAndSortBooks() {
        const query = searchInput.value.toLowerCase().trim();
        const selectedCat = filterCategory.value;
        const selectedStatus = filterStatus.value;
        const selectedSort = filterSort.value;

        let visibleCount = 0;
        let booksArray = Array.from(originalBooks);

        // 1. FILTERING
        booksArray.forEach(card => {
            const title = card.getAttribute('data-title');
            const author = card.getAttribute('data-author');
            const category = card.getAttribute('data-category');
            const status = card.getAttribute('data-status');

            const matchesSearch = title.includes(query) || author.includes(query);
            const matchesCategory = (selectedCat === 'all' || category === selectedCat);
            const matchesStatus = (selectedStatus === 'all' || status === selectedStatus);

            if (matchesSearch && matchesCategory && matchesStatus) {
                card.style.display = ''; // Tampilkan
                visibleCount++;
            } else {
                card.style.display = 'none'; // Sembunyikan
            }
        });

        // 2. SORTING (Hanya mengurutkan elemen yang berada di dalam grid saat ini)
        if (selectedSort === 'az') {
            booksArray.sort((a, b) => a.getAttribute('data-title').localeCompare(b.getAttribute('data-title')));
        } else if (selectedSort === 'za') {
            booksArray.sort((a, b) => b.getAttribute('data-title').localeCompare(a.getAttribute('data-title')));
        } else {
            // Urutan default (kembalikan ke struktur asli DOM awal)
            booksArray = originalBooks;
        }

        // Terapkan hasil urutan baru ke DOM container
        booksArray.forEach(card => booksGrid.appendChild(card));

        // Update jumlah hasil pencarian
        resultCount.textContent = `${visibleCount} buku ditemukan`;
    }

    // Trigger filter setiap kali input berubah atau tombol cari ditekan
    searchInput.addEventListener('input', filterAndSortBooks);
    searchBtn.addEventListener('click', filterAndSortBooks);
    filterCategory.addEventListener('change', filterAndSortBooks);
    filterStatus.addEventListener('change', filterAndSortBooks);
    filterSort.addEventListener('change', filterAndSortBooks);

    // Reset tombol
    resetFilters.addEventListener('click', function () {
        searchInput.value = '';
        filterCategory.value = 'all';
        filterStatus.value = 'all';
        filterSort.value = 'default';
        filterAndSortBooks();
    });
});
</script>
@endsection