@extends('layouts.layout-admin')

@section('title', 'Data Buku')
@section('page-title')
    <h1>Data Buku</h1>
@endsection

@section('content')
    <div class="table-card">

        <!-- Alert Success -->
        @if (session('success'))
            <div style="padding: 12px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-header"
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3>Daftar Buku</h3>
            <!-- Modal Tambah -->
            <button onclick="openAddModal()">
                <i class="fa-solid fa-plus"></i> Tambah Buku
            </button>
        </div>

        <!-- PENCARIAN & FILTER -->
        <div class="filter-wrapper" style="margin-bottom: 20px; padding: 15px; background: #f9f9f9; border-radius: 8px;">
            <form action="{{ route('admin.books') }}" method="GET"
                style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
                <div class="filter-group"
                    style="display: flex; flex-direction: column; gap: 5px; flex-grow: 1; min-width: 200px;">
                    <input type="text" name="search_book" placeholder="Masukkan judul atau penulis..."
                        value="{{ request('search_book') }}"
                        style="padding: 8px 10px; border: 1px solid #ddd; border-radius: 4px; width: 100%;">
                </div>

                <div class="filter-group" style="display: flex; flex-direction: column; gap: 5px;">
                    <select name="category"
                        style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; min-width: 150px;">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group" style="display: flex; flex-direction: column; gap: 5px;">
                    <select name="status"
                        style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; min-width: 120px;">
                        <option value="">Semua Status</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                        <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                    </select>
                </div>

                <div style="display: flex; gap: 10px;">
                    <button type="submit"
                        style="padding: 8px 15px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Cari
                        & Filter</button>
                    @if (request('category') || request('status') || request('search_book'))
                        <a href="{{ route('admin.books') }}"
                            style="padding: 8px 12px; background: #e0e0e0; border-radius: 4px; color: #333; text-decoration: none; font-size: 0.85rem;">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- TABEL DATA -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>{{ sprintf('%03d', $book->id) }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->category->name ?? 'Tanpa Kategori' }}</td>
                        <td>
                            @if ($book->status === 'available')
                                <span class="badge success">Tersedia</span>
                            @else
                                <span class="badge warning">Dipinjam</span>
                            @endif
                        </td>
                        <td>
                            <i class="fa-solid fa-pen-to-square edit" style="cursor: pointer; margin-right: 8px;"
                                onclick="openEditModal({{ json_encode($book) }})"></i>

                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
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
                        <td colspan="6" style="text-align: center; color: #888; padding: 20px;">Buku tidak ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $books->links() }}
        </div>
    </div>

    <!-- ==================== MODAL FORM (TAMBAH / EDIT) ==================== -->
    <div id="bookModal"
        style="display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
        <div
            style="background: white; padding: 25px; border-radius: 8px; width: 450px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            <h3 id="modalTitle" style="margin-top: 0; margin-bottom: 20px;">Tambah Buku</h3>

            <form id="modalForm" action="" method="POST">
                @csrf
                <input type="hidden" id="methodField" name="_method" value="POST">

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Judul Buku</label>
                    <input type="text" id="formTitle" name="title" required
                        style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Penulis</label>
                    <input type="text" id="formAuthor" name="author" required
                        style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Kategori</label>
                    <select id="formCategory" name="category_id" required
                        style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Total Stok Buku</label>
                    <input type="number" id="formTotalCopies" name="total_copies" min="0" required
                        style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div id="availableCopiesGroup" style="margin-bottom: 15px; display: none;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Stok Tersedia Saat Ini</label>
                    <input type="number" id="formAvailableCopies" name="available_copies" min="0"
                        style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Status</label>
                    <select id="formStatus" name="status" required
                        style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="available">Tersedia</option>
                        <option value="borrowed">Dipinjam</option>
                    </select>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" onclick="closeModal()"
                        style="padding: 8px 15px; background: #e0e0e0; border: none; border-radius: 4px; cursor: pointer;">Batal</button>
                    <button type="submit"
                        style="padding: 8px 15px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('bookModal');
        const form = document.getElementById('modalForm');
        const modalTitle = document.getElementById('modalTitle');
        const methodField = document.getElementById('methodField');
        const availableGroup = document.getElementById('availableCopiesGroup');
        const inputAvailable = document.getElementById('formAvailableCopies');

        function openAddModal() {
            modalTitle.innerText = "Tambah Buku";
            form.action = "{{ route('admin.books.store') }}";
            methodField.value = "POST";

            availableGroup.style.display = "none";
            inputAvailable.removeAttribute('required');

            // Reset isian form
            document.getElementById('formTitle').value = "";
            document.getElementById('formAuthor').value = "";
            document.getElementById('formCategory').value = "";
            document.getElementById('formTotalCopies').value = "";
            document.getElementById('formStatus').value = "available";

            modal.style.display = "flex";
        }

        function openEditModal(book) {
            modalTitle.innerText = "Edit Data Buku";
            form.action = `/admin/data-buku/${book.id}`;
            methodField.value = "PUT";
            availableGroup.style.display = "block";
            inputAvailable.setAttribute('required', 'required');

            // Isi data lama ke form modal
            document.getElementById('formTitle').value = book.title;
            document.getElementById('formAuthor').value = book.author;
            document.getElementById('formCategory').value = book.category_id;
            document.getElementById('formTotalCopies').value = book.total_copies;
            document.getElementById('formAvailableCopies').value = book.available_copies;
            document.getElementById('formStatus').value = book.status;

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
