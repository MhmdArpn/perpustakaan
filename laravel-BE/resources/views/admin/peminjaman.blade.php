@extends('layouts.layout-admin')

@section('title', 'Peminjaman Buku - Perpustakaan')
@section('page-title')
    <h1>Peminjaman</h1>
    <p>Kelola transaksi peminjaman buku</p>
@endsection

@section('content')
    <div class="table-card">

        @if (session('success'))
            <div style="padding: 12px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div style="padding: 12px; background: #f8d7da; color: #721c24; border-radius: 4px; margin-bottom: 15px;">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-header"
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3>Daftar Peminjaman</h3>
            <button onclick="openAddModal()">
                <i class="fa-solid fa-plus"></i> Tambah Peminjaman
            </button>
        </div>

        <div class="filter-wrapper" style="margin-bottom: 20px; padding: 15px; background: #f9f9f9; border-radius: 8px;">
            <form action="{{ route('admin.loans') }}" method="GET"
                style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
                
                <div class="filter-group"
                    style="display: flex; flex-direction: column; gap: 5px; flex-grow: 1; min-width: 200px;">
                    <input type="text" name="search" placeholder="Masukkan nama anggota..."
                        value="{{ request('search') }}"
                        style="padding: 8px 10px; border: 1px solid #ddd; border-radius: 4px; width: 100%;">
                </div>

                <div class="filter-group" style="display: flex; flex-direction: column; gap: 5px;">
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; min-width: 140px;"
                        title="Tanggal Mulai">
                </div>

                <div style="align-self: center; padding-bottom: 8px; color: #888;">s/d</div>

                <div class="filter-group" style="display: flex; flex-direction: column; gap: 5px;">
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; min-width: 140px;"
                        title="Tanggal Selesai">
                </div>

                <div class="filter-group" style="display: flex; flex-direction: column; gap: 5px;">
                    <select name="status"
                        style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; min-width: 150px;">
                        <option value="">Semua Status</option>
                        <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="terlambat" {{ request('status') == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                    </select>
                </div>

                <div style="display: flex; gap: 10px;">
                    <button type="submit"
                        style="padding: 8px 15px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
                        Cari & Filter
                    </button>
                    @if (request('search') || request('status') || request('start_date') || request('end_date'))
                        <a href="{{ route('admin.loans') }}"
                            style="padding: 8px 12px; background: #e0e0e0; border-radius: 4px; color: #333; text-decoration: none; font-size: 0.85rem;">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr>
                        <td>PM{{ sprintf('%03d', $loan->id) }}</td>
                        <td>{{ $loan->user->name ?? 'User Terhapus' }}</td>
                        <td>{{ $loan->book->title ?? 'Buku Terhapus' }}</td>
                        <td>{{ $loan->loaned_at ? $loan->loaned_at->format('d M Y') : '-' }}</td>
                        <td>{{ $loan->due_at ? $loan->due_at->format('d M Y') : '-' }}</td>
                        <td>
                            @if($loan->status === 'selesai')
                                <span class="badge success">Selesai</span>
                            @elseif($loan->status === 'terlambat')
                                <span class="badge danger">Terlambat</span>
                            @else
                                <span class="badge info">Dipinjam</span>
                            @endif
                        </td>
                        <td>
                            <i class="fa-solid fa-pen-to-square edit" style="cursor: pointer; margin-right: 8px;"
                                onclick="openEditModal({{ json_encode($loan) }})"></i>

                            <form action="{{ route('admin.loans.destroy', $loan->id) }}" method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
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
                        <td colspan="7" style="text-align: center; color: #888; padding: 20px;">Data peminjaman tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $loans->links() }}
        </div>
    </div>

    <div id="loanModal"
        style="display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
        <div style="background: white; padding: 25px; border-radius: 8px; width: 450px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            <h3 id="modalTitle" style="margin-top: 0; margin-bottom: 20px;">Tambah Transaksi Peminjaman</h3>

            <form id="modalForm" action="" method="POST">
                @csrf
                <input type="hidden" id="methodField" name="_method" value="POST">

                <div id="creationFields">
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nama Anggota</label>
                        <select id="formUser" name="user_id" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="">Pilih Anggota</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Buku yang Dipinjam</label>
                        <select id="formBook" name="book_id" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="">Pilih Buku</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}">{{ $book->title }} (Stok: {{ $book->available_copies }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom: 15px; display: flex; gap: 10px;">
                        <div style="flex: 1;">
                            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Tgl Pinjam</label>
                            <input type="date" id="formLoanedAt" name="loaned_at" value="{{ date('Y-m-d') }}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                        </div>
                        <div style="flex: 1;">
                            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Deadline</label>
                            <input type="date" id="formDueAt" name="due_at" value="{{ date('Y-m-d', strtotime('+7 days')) }}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                        </div>
                    </div>
                </div>

                <div id="editFields" style="display: none; margin-bottom: 15px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Status Peminjaman</label>
                    <select id="formStatus" name="status" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="dipinjam">Dipinjam</option>
                        <option value="selesai">Selesai (Dikembangkan)</option>
                        <option value="terlambat">Terlambat</option>
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Catatan (Opsional)</label>
                    <textarea id="formNotes" name="notes" rows="3" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-family: inherit; resize: vertical;"></textarea>
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
        const modal = document.getElementById('loanModal');
        const form = document.getElementById('modalForm');
        const modalTitle = document.getElementById('modalTitle');
        const methodField = document.getElementById('methodField');
        
        const creationFields = document.getElementById('creationFields');
        const editFields = document.getElementById('editFields');

        function openAddModal() {
            modalTitle.innerText = "Tambah Transaksi Peminjaman";
            form.action = "{{ route('admin.loans.store') }}";
            methodField.value = "POST";

            creationFields.style.display = "block";
            editFields.style.display = "none";

            document.getElementById('formUser').setAttribute('required', 'required');
            document.getElementById('formBook').setAttribute('required', 'required');

            // Reset value fields
            document.getElementById('formUser').value = "";
            document.getElementById('formBook').value = "";
            document.getElementById('formNotes').value = "";

            modal.style.display = "flex";
        }

        function openEditModal(loan) {
            modalTitle.innerText = `Edit Transaksi PM${String(loan.id).padStart(3, '0')}`;
            form.action = `/admin/peminjaman/${loan.id}`;
            methodField.value = "PUT";

            creationFields.style.display = "none";
            editFields.style.display = "block";

            document.getElementById('formUser').removeAttribute('required');
            document.getElementById('formBook').removeAttribute('required');

            // Set data lama ke modal input edit
            document.getElementById('formStatus').value = loan.status;
            document.getElementById('formNotes').value = loan.notes || "";

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