@extends('layouts.layout-user')

@section('title', 'Kategori Buku')

@section('page-title')
    <h1 style="margin: 0; font-size: 1.5rem; color: #333;">Kategori</h1>
    <p class="page-label" style="margin: 0; color: #777; font-size: 0.9rem;">Jelajahi kategori favoritmu dan temukan pengetahuan baru</p>
@endsection

@section('content')

<!-- BARIS KATEGORI (Dinamis dari Database) -->
<div class="category-row" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 16px; margin-bottom: 40px;">
    @php
        // Pemetaan warna dan icon fallback berdasarkan index kategori
        $colors = ['blue', 'yellow', 'green', 'purple', 'orange', 'gray'];
        $icons = [
            'programming' => 'fa-code',
            'novel' => 'fa-book-open',
            'science' => 'fa-flask',
            'finance' => 'fa-chart-line',
            'history' => 'fa-landmark',
            'ui/ux' => 'fa-pencil-alt',
            'default' => 'fa-tag'
        ];
    @endphp

    @forelse($categories as $index => $category)
        @php
            $slug = Str::slug($category->name);
            $cardColor = $colors[$index % count($colors)];
            // Pilih icon yang cocok dengan slug, jika tidak ada pakai default
            $iconClass = $icons[$slug] ?? $icons['default'];
        @endphp
        
        <div class="category-card {{ $cardColor }}" 
             style="cursor: pointer;" 
             data-target-slug="{{ $slug }}"
             data-category-name="{{ $category->name }}"
             onclick="selectCategory('{{ $slug }}', '{{ $category->name }}')">
            <div class="category-icon"><i class="fa-solid {{ $iconClass }}"></i></div>
            <strong>{{ $category->name }}</strong>
            <span>{{ $category->books_count ?? $category->books->count() }} Buku</span>
        </div>
    @empty
        <p style="color: #888; font-style: italic;">Tidak ada kategori yang tersedia.</p>
    @endforelse
</div>

<!-- BAGIAN JUDUL BUKU KATEGORI TERPILIH -->
<div class="section-title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <div>
        <h2 id="selectedCategoryTitle">Buku Berdasarkan Kategori: {{ $categories->first()->name ?? 'Semua' }}</h2>
        <p class="section-subtitle" id="selectedCategorySubtitle">Menampilkan koleksi buku terbaik pilihanmu</p>
    </div>
    <a href="{{ route('user.cari-buku') }}" class="btn-outline" style="text-decoration: none;">Lihat Semua</a>
</div>

<!-- DAFTAR BUKU FILTERABLE -->
<div class="books category-books" id="booksCategoryContainer">
    @forelse($books as $book)
        @php
            $isAvailable = ($book->qty ?? 1) > 0;
            $bookCategorySlug = isset($book->category) ? Str::slug($book->category->name) : 'umum';
        @endphp
        
        <div class="book-card" data-category="{{ $bookCategorySlug }}">
            <div class="book-image" style="position: relative;">
                @if(!empty($book->cover))
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}">
                @else
                    @php $hexColor = substr(md5($book->title), 0, 6); @endphp
                    <div style="width: 100%; height: 250px; border-radius: 8px; background: linear-gradient(135deg, #{{ $hexColor }}, #2c3e50); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 15px; text-align: center; color: white; font-weight: bold;">
                        <span style="font-size: 0.95rem;">{{ $book->title }}</span>
                    </div>
                @endif
                <span class="rating">4.8</span>
            </div>
            <h3>{{ $book->title }}</h3>
            <p>{{ $book->author ?? 'Penulis Tidak Diketahui' }}</p>
            <div class="book-meta" style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                @if($isAvailable)
                    <span class="badge-blue">Available</span>
                @else
                    <span class="badge-red">Borrowed</span>
                @endif
                <a class="bookmark" style="cursor: pointer; color: #888;"><i class="fa-regular fa-bookmark"></i></a>
            </div>
        </div>
    @empty
        <p class="no-books-msg" style="grid-column: 1/-1; text-align: center; color: #888; padding: 30px 0;">
            Koleksi buku kosong di database.
        </p>
    @endforelse
</div>

<!-- CLIENT-SIDE FILTER ENGINE -->
<script>
function selectCategory(slug, name) {
    // 1. Update teks judul & subjudul dinamis di atas list buku
    document.getElementById('selectedCategoryTitle').innerText = 'Buku Berdasarkan Kategori: ' + name;
    document.getElementById('selectedCategorySubtitle').innerText = 'Menampilkan koleksi buku ' + name + ' terbaik';

    // 2. Filter kartu buku berdasarkan atribut data-category
    const bookCards = document.querySelectorAll('#booksCategoryContainer .book-card');
    let visibleCount = 0;

    bookCards.forEach(card => {
        if (card.getAttribute('data-category') === slug) {
            card.style.display = '';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    // 3. Tampilkan pesan jika buku di kategori tersebut kosong
    let noMsg = document.getElementById('tempNoBooksMessage');
    if (visibleCount === 0) {
        if (!noMsg) {
            noMsg = document.createElement('p');
            noMsg.id = 'tempNoBooksMessage';
            noMsg.style.cssText = 'grid-column: 1/-1; text-align: center; color: #888; padding: 40px 0; font-style: italic;';
            noMsg.innerText = 'Belum ada koleksi buku di kategori ' + name;
            document.getElementById('booksCategoryContainer').appendChild(noMsg);
        } else {
            noMsg.innerText = 'Belum ada koleksi buku di kategori ' + name;
            noMsg.style.display = '';
        }
    } else if (noMsg) {
        noMsg.style.display = 'none';
    }

    // 4. Highlight Kategori Aktif (Opsional efek visual)
    document.querySelectorAll('.category-card').forEach(card => {
        card.style.transform = 'none';
        card.style.boxShadow = 'none';
    });
    const activeCard = document.querySelector(`[data-target-slug="${slug}"]`);
    if(activeCard) {
        activeCard.style.transform = 'translateY(-5px)';
        activeCard.style.boxShadow = '0 5px 15px rgba(0,0,0,0.08)';
    }
}

// Inisialisasi: Klik otomatis kategori pertama yang muncul di sistem saat pertama kali load
document.addEventListener('DOMContentLoaded', function() {
    const firstCategoryCard = document.querySelector('.category-card');
    if (firstCategoryCard) {
        const slug = firstCategoryCard.getAttribute('data-target-slug');
        const name = firstCategoryCard.getAttribute('data-category-name');
        selectCategory(slug, name);
    }
});
</script>
@endsection