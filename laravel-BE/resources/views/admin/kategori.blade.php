@extends('layouts.layout-admin')

@section('title', 'Kategori Buku')
@section('page-title')
<h1>Kategori Buku</h1>
<p>Kelola kategori koleksi perpustakaan</p>
@endsection

@section('content')
<!-- Notifikasi Alert -->
@if(session('success'))
    <div style="padding: 12px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div style="padding: 12px; background: #f8d7da; color: #721c24; border-radius: 4px; margin-bottom: 15px;">
        {{ session('error') }}
    </div>
@endif

<!-- Stat Cards Dinamis -->
<div class="cards">
    <div class="card">
        <div>
            <p>Total Kategori</p>
            <h2>{{ $totalKategori }}</h2>
        </div>
        <i class="fa-solid fa-layer-group"></i>
    </div>
    <div class="card">
        <div>
            <p>Kategori Aktif</p>
            <h2>{{ $kategoriAktif }}</h2>
        </div>
        <i class="fa-solid fa-circle-check"></i>
    </div>
    <div class="card">
        <div>
            <p>Baru Ditambahkan</p>
            <h2>{{ $baruDitambahkan }}</h2>
        </div>
        <i class="fa-solid fa-plus"></i>
    </div>
</div>

<!-- Table Card -->
<div class="table-card" style="margin-top: 20px;">
    <div class="table-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3>Daftar Kategori</h3>
        
        <!-- Filter Pencarian Internal Khusus Kategori & Tombol Tambah -->
        <div style="display: flex; gap: 15px; align-items: center;">
            <form action="{{ route('admin.categories') }}" method="GET" style="display: flex; gap: 8px;">
                <input type="text" name="search_category" placeholder="Cari nama kategori..." value="{{ request('search_category') }}" style="padding: 8px 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 0.85rem;">
                <button type="submit" style="padding: 8px 12px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Cari</button>
                @if(request('search_category'))
                    <a href="{{ route('admin.categories') }}" style="padding: 8px 12px; background: #e0e0e0; border-radius: 4px; color: #333; text-decoration: none; font-size: 0.85rem;">Reset</a>
                @endif
            </form>
            
            <button onclick="openAddModal()">
                <i class="fa-solid fa-plus"></i> Tambah Kategori
            </button>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Jumlah Buku</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>KT{{ sprintf('%03d', $category->id) }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->books_count }}</td>
                    <td>
                        @if($category->is_active)
                            <span class="badge success">Aktif</span>
                        @else
                            <span class="badge warning">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <i class="fa-solid fa-pen-to-square edit" style="cursor: pointer; margin-right: 8px;" 
                           onclick="openEditModal({{ json_encode($category) }})"></i>
                        
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                <i class="fa-solid fa-trash delete" style="color: red;"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #888; padding: 20px;">Kategori tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $categories->links() }}
    </div>
</div>

<!-- ==================== MODAL FORM KATEGORI ==================== -->
<div id="categoryModal" style="display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
    <div style="background: white; padding: 25px; border-radius: 8px; width: 400px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
        <h3 id="modalTitle" style="margin-top: 0; margin-bottom: 20px;">Tambah Kategori</h3>
        
        <form id="modalForm" action="" method="POST">
            @csrf
            <input type="hidden" id="methodField" name="_method" value="POST">

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nama Kategori</label>
                <input type="text" id="formName" name="name" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Deskripsi</label>
                <textarea name="description" id="formDescription" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required></textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Status</label>
                <select id="formStatus" name="is_active" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal()" style="padding: 8px 15px; background: #e0e0e0; border: none; border-radius: 4px; cursor: pointer;">Batal</button>
                <button type="submit" style="padding: 8px 15px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Kontrol Modal Kategori -->
<script>
    const modal = document.getElementById('categoryModal');
    const form = document.getElementById('modalForm');
    const modalTitle = document.getElementById('modalTitle');
    const methodField = document.getElementById('methodField');

    function openAddModal() {
        modalTitle.innerText = "Tambah Kategori";
        form.action = "{{ route('admin.categories.store') }}";
        methodField.value = "POST";
        
        document.getElementById('formName').value = "";
        document.getElementById('formDescription').value = "";
        document.getElementById('formStatus').value = "1";
        
        modal.style.display = "flex";
    }

    function openEditModal(category) {
        modalTitle.innerText = "Edit Kategori";
        form.action = `/admin/kategori/${category.id}`;
        methodField.value = "PUT";
        
        document.getElementById('formName').value = category.name;
        document.getElementById('formDescription').value = category.description;
        document.getElementById('formStatus').value = category.is_active;
        
        modal.style.display = "flex";
    }

    function closeModal() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            closeModal();
        }
    }
</script>
@endsection