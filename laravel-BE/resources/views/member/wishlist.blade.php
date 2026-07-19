@extends('layouts.layout-user')

@section('title', 'Wishlist Saya')

@section('page-title')
    <h1 style="margin: 0; font-size: 1.5rem; color: #333;">Wishlist Saya</h1>
@endsection

@section('content')
<!-- HEADER HALAMAN -->
<div class="page-header" style="margin-bottom: 24px;">
    <div>
        <h1 style="margin: 0; font-size: 1.8rem;">Wishlist Saya</h1>
        <p class="page-sub-label" style="margin: 4px 0 0 0; color: #777;">Simpan buku favoritmu untuk dibaca nanti.</p>
    </div>
</div>

<!-- CARDS INFORMASI (STATISTIK DINAMIS) -->
<div class="cards" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px;">
    <div class="card" style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #eee; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <div>
            <p style="text-transform: none; margin: 0; color: #777; font-size: 0.85rem;">TOTAL WISHLIST</p>
            <h2 style="margin: 8px 0 0 0; font-size: 1.8rem; color: #2c3e50;">{{ $wishlistCount }} Buku</h2>
        </div>
    </div>
    <div class="card" style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #eee; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <div>
            <p style="text-transform: none; margin: 0; color: #777; font-size: 0.85rem;">AVAILABLE (SIAP PINJAM)</p>
            <h2 style="margin: 8px 0 0 0; font-size: 1.8rem; color: #2ecc71;">{{ $availableCount }} Buku</h2>
        </div>
    </div>
    <div class="card" style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #eee; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <div>
            <p style="text-transform: none; margin: 0; color: #777; font-size: 0.85rem;">BORROWED (SEDANG DIPINJAM)</p>
            <h2 style="margin: 8px 0 0 0; font-size: 1.8rem; color: #e74c3c;">{{ $borrowedCount }} Buku</h2>
        </div>
    </div>
</div>

<!-- BAR FILTER DAN PENCARIAN -->
<div class="filter-bar" style="display: flex; gap: 12px; margin-bottom: 24px; align-items: center; justify-content: space-between; flex-wrap: wrap;">
    <div class="search-book" style="flex: 1; min-width: 250px; display: flex; align-items: center; background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 10px 14px; gap: 10px;">
        <i class="fa-solid fa-magnifying-glass" style="color: #888;"></i>
        <input type="text" id="wishlistSearch" placeholder="Cari wishlist..." style="border: none; outline: none; width: 100%; font-size: 0.95rem; background: transparent;">
    </div>
    <div style="display: flex; gap: 8px;">
        <select id="categoryFilter" style="padding: 10px 14px; border-radius: 8px; border: 1px solid #ddd; background: #fff; font-size: 0.9rem; cursor: pointer; outline: none;">
            <option value="all">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ Str::slug($category->name) }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<!-- DAFTAR BUKU WISHLIST -->
<div class="books" id="wishlistContainer">
    @forelse($wishlists as $wishlist)
        @php
            $book = $wishlist->book;
            $isAvailable = ($book->available_copies ?? 0) > 0;
            $categorySlug = isset($book->category) ? Str::slug($book->category->name) : 'umum';
        @endphp

        <div class="book-card" data-title="{{ strtolower($book->title ?? '') }}" data-author="{{ strtolower($book->author ?? '') }}" data-category="{{ $categorySlug }}">
            <div class="book-image" style="position: relative;">
                @if(!empty($book->cover))
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}">
                @else
                    @php $hexColor = substr(md5($book->title ?? 'Buku'), 0, 6); @endphp
                    <div style="width: 100%; height: 250px; border-radius: 8px; background: linear-gradient(135deg, #{{ $hexColor }}, #2c3e50); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 15px; text-align: center; color: white; font-weight: bold;">
                        <span style="font-size: 0.95rem;">{{ $book->title }}</span>
                    </div>
                @endif

                <!-- Form Tombol Hapus dari Wishlist (Icon Hati Merah) -->
                <form action="{{ route('user.wishlist.destroy', $wishlist->id) }}" method="POST" style="position: absolute; top: 10px; right: 10px; z-index: 10;" onsubmit="return confirm('Hapus buku ini dari daftar wishlist?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="wishlist-badge" style="background: rgba(255, 255, 255, 0.9); border: none; outline: none; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #e74c3c; box-shadow: 0 2px 5px rgba(0,0,0,0.15); transition: all 0.2s;">
                        <i class="fa-solid fa-heart"></i>
                    </button>
                </form>
            </div>

            <h3>{{ $book->title }}</h3>
            <p>{{ $book->author ?? 'Penulis Tidak Diketahui' }}</p>
            
            <div class="book-meta" style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                @if($isAvailable)
                    <span class="badge-blue">AVAILABLE</span>
                @else
                    <span class="badge-red">BORROWED</span>
                @endif
                <span class="rating">★ 4.8</span>
            </div>

            <!-- Tombol Aksi Peminjaman -->
            <div style="margin-top: 12px;">
                @if($isAvailable)
                    <form action="{{ route('user.pinjam', $book->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-primary" style="width: 100%; padding: 10px; border-radius: 6px; font-weight: bold;">
                            Pinjam Sekarang
                        </button>
                    </form>
                @else
                    <button class="btn-outline" disabled style="width: 100%; padding: 10px; border-radius: 6px; cursor: not-allowed; background: #f5f5f5; color: #aaa;">
                        Buku Sedang Diantri
                    </button>
                @endif
            </div>
        </div>
    @empty
        <div class="no-books" style="grid-column: 1/-1; text-align: center; color: #888; padding: 50px 0; background: #fff; border-radius: 8px; border: 1px dashed #ccc;">
            <i class="fa-regular fa-heart" style="font-size: 3rem; color: #ccc; margin-bottom: 12px; display: block;"></i>
            Belum ada buku di wishlist kamu. <a href="{{ route('user.cari-buku') }}" style="color: #3498db; text-decoration: none; font-weight: bold;">Cari buku di sini</a>.
        </div>
    @endforelse
</div>

<!-- CLIENT-SIDE LIVE FILTER -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('wishlistSearch');
    const categoryFilter = document.getElementById('categoryFilter');
    const bookCards = document.querySelectorAll('#wishlistContainer .book-card');

    function filterWishlist() {
        const query = searchInput.value.toLowerCase().trim();
        const selectedCategory = categoryFilter.value;

        bookCards.forEach(card => {
            const title = card.getAttribute('data-title');
            const author = card.getAttribute('data-author');
            const category = card.getAttribute('data-category');

            const matchesSearch = title.includes(query) || author.includes(query);
            const matchesCategory = (selectedCategory === 'all' || category === selectedCategory);

            if (matchesSearch && matchesCategory) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    if (searchInput && categoryFilter) {
        searchInput.addEventListener('input', filterWishlist);
        categoryFilter.addEventListener('change', filterWishlist);
    }
});
</script>
@endsection