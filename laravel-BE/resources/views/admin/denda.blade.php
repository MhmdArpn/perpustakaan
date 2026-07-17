@extends('layouts.layout-admin')

@section('title', 'Kelola Denda')

@section('page-title')
    <h1>Denda</h1>
    <p>Kelola seluruh data denda perpustakaan</p>
@endsection

@section('content')
    <!-- STATISTIC CARDS -->
    <div class="cards">
        <div class="card">
            <div>
                <p>Total Denda</p>
                <h2>Rp{{ number_format($totalDenda, 0, ',', '.') }}</h2>
            </div>
            <i class="fa-solid fa-money-bill-wave"></i>
        </div>
        <div class="card">
            <div>
                <p>Belum Bayar</p>
                <h2>{{ $belumBayar }}</h2>
            </div>
            <i class="fa-solid fa-circle-exclamation"></i>
        </div>
        <div class="card">
            <div>
                <p>Lunas</p>
                <h2>{{ $lunas }}</h2>
            </div>
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div class="card">
            <div>
                <p>Bulan Ini</p>
                <h2>Rp{{ number_format($bulanIni, 0, ',', '.') }}</h2>
            </div>
            <i class="fa-solid fa-chart-line"></i>
        </div>
    </div>

    <!-- MAIN CONTAINER -->
    <div class="table-card" style="margin-top: 20px;">
        
        @if (session('success'))
            <div style="padding: 12px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3>Data Denda</h3>
            
            <div style="display: flex; gap: 10px; align-items: center;">
                <form action="{{ route('admin.fines') }}" method="GET" style="display: flex; gap: 5px;">
                    <input type="text" name="search" placeholder="Cari member atau buku..." value="{{ request('search') }}"
                        style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; min-width: 200px;">
                    <button type="submit" style="padding: 8px 12px; background: #555; color: white; border: none; border-radius: 4px; cursor: pointer;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.fines') }}" style="padding: 8px 12px; background: #eee; color: #333; border-radius: 4px; text-decoration: none; font-size: 0.85rem;">Reset</a>
                    @endif
                </form>
                
                <button onclick="openAddModal()">
                    <i class="fa-solid fa-plus"></i> Tambah Denda
                </button>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Member</th>
                    <th>Buku</th>
                    <th>Keterlambatan</th>
                    <th>Denda</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fines as $fine)
                    <tr>
                        <td>#DN{{ sprintf('%03d', $fine->id) }}</td>
                        <td>{{ $fine->user->name ?? 'User Terhapus' }}</td>
                        <td>{{ $fine->book->title ?? 'Buku Terhapus' }}</td>
                        <td>{{ $fine->late_days > 0 ? $fine->late_days . ' Hari' : '-' }}</td>
                        <td>Rp{{ number_format($fine->amount, 0, ',', '.') }}</td>
                        <td>
                            @if($fine->status === 'paid')
                                <span class="badge success">Lunas</span>
                            @else
                                <span class="badge warning">Belum Bayar</span>
                            @endif
                        </td>
                        <td>
                            <i class="fa-solid fa-pen-to-square edit" style="cursor: pointer; margin-right: 10px; color: #3498db;"
                               onclick="openEditModal({{ json_encode($fine) }})"></i>
                            
                            <form action="{{ route('admin.fines.destroy', $fine->id) }}" method="POST" style="display: inline;"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan denda ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                    <i class="fa-solid fa-trash delete" style="color: #e74c3c;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: #888; padding: 20px;">Tidak ada data denda ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $fines->links() }}
        </div>
    </div>

    <!-- ==================== MODAL TAMBAH DENDA ==================== -->
    <div id="addModal" style="display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
        <div style="background: white; padding: 25px; border-radius: 8px; width: 450px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            <h3 style="margin-top: 0; margin-bottom: 20px;">Tambah Catatan Denda</h3>
            <form action="{{ route('admin.fines.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Pilih Member</label>
                    <select name="user_id" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">-- Pilih Anggota --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Pilih Buku</label>
                    <select name="book_id" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">-- Pilih Judul Buku --</option>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="margin-bottom: 12px; display: flex; gap: 15px;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Keterlambatan (Hari)</label>
                        <input type="number" name="late_days" value="0" min="0" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nominal Denda (Rp)</label>
                        <input type="number" name="amount" required min="0" placeholder="e.g. 5000" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Status</label>
                    <select name="status" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="unpaid">Belum Bayar</option>
                        <option value="paid">Lunas</option>
                    </select>
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Keterangan / Catatan</label>
                    <textarea name="notes" placeholder="Contoh: Keterlambatan pengembalian atau Buku Rusak" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; resize: vertical; height: 60px;"></textarea>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                    <button type="button" onclick="closeAddModal()" style="padding: 8px 15px; background: #e0e0e0; border: none; border-radius: 4px; cursor: pointer;">Batal</button>
                    <button type="submit" style="padding: 8px 15px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== MODAL EDIT DENDA ==================== -->
    <div id="editModal" style="display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
        <div style="background: white; padding: 25px; border-radius: 8px; width: 450px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            <h3 style="margin-top: 0; margin-bottom: 20px;">Ubah Informasi Denda</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px; color:#777;">Member & Buku (ReadOnly)</label>
                    <input type="text" id="edit_display_info" disabled style="width: 100%; padding: 8px; background: #f5f5f5; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nominal Denda (Rp)</label>
                    <input type="number" name="amount" id="edit_amount" required min="0" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Status</label>
                    <select name="status" id="edit_status" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="unpaid">Belum Bayar</option>
                        <option value="paid">Lunas</option>
                    </select>
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Keterangan</label>
                    <textarea name="notes" id="edit_notes" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; resize: vertical; height: 60px;"></textarea>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                    <button type="button" onclick="closeEditModal()" style="padding: 8px 15px; background: #e0e0e0; border: none; border-radius: 4px; cursor: pointer;">Batal</button>
                    <button type="submit" style="padding: 8px 15px; background: #3498db; color: white; border: none; border-radius: 4px; cursor: pointer;">Perbarui</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        const addModal = document.getElementById('addModal');
        const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');

        function openAddModal() { addModal.style.display = "flex"; }
        function closeAddModal() { addModal.style.display = "none"; }

        function openEditModal(fine) {
            document.getElementById('edit_display_info').value = `${fine.user.name} - ${fine.book.title}`;
            document.getElementById('edit_amount').value = Math.round(fine.amount);
            document.getElementById('edit_status').value = fine.status;
            document.getElementById('edit_notes').value = fine.notes || '';
            
            editForm.action = `/admin/denda/${fine.id}`;
            editModal.style.display = "flex";
        }
        function closeEditModal() { editModal.style.display = "none"; }

        window.onclick = function(event) {
            if (event.target == addModal) closeAddModal();
            if (event.target == editModal) closeEditModal();
        }
    </script>
@endsection