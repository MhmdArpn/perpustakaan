@extends('layouts.layout-admin')

@section('title', 'Data Pengembalian')
@section('page-title')
    <h1>Pengembalian</h1>
    <p>Kelola transaksi pengembalian buku</p>
@endsection

@section('content')
    <!-- STATISTIC CARDS -->
    <div class="cards">
        <div class="card">
            <div>
                <p>Total Kembali</p>
                <h2>{{ number_format($totalKembali, 0, ',', '.') }}</h2>
            </div>
            <i class="fa-solid fa-book"></i>
        </div>
        <div class="card">
            <div>
                <p>Hari Ini</p>
                <h2>{{ number_format($hariIni, 0, ',', '.') }}</h2>
            </div>
            <i class="fa-solid fa-calendar"></i>
        </div>
        <div class="card">
            <div>
                <p>Terlambat</p>
                <h2>{{ number_format($totalTerlambat, 0, ',', '.') }}</h2>
            </div>
            <i class="fa-solid fa-clock"></i>
        </div>
        <div class="card">
            <div>
                <p>Total Denda</p>
                <h2>Rp{{ number_format($totalDenda, 0, ',', '.') }}</h2>
            </div>
            <i class="fa-solid fa-money-bill"></i>
        </div>
    </div>

    <!-- MAIN TABLE & FILTER CONTAINER -->
    <div class="table-card" style="margin-top: 20px;">
        
        <!-- Alert Success Laravel -->
        @if (session('success'))
            <div style="padding: 12px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-header"
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3>Daftar Pengembalian</h3>
            <button onclick="openAddModal()">
                <i class="fa-solid fa-plus"></i> Tambah Pengembalian
            </button>
        </div>

        <!-- PENCARIAN & FILTER -->
        <div class="filter-wrapper" style="margin-bottom: 20px; padding: 15px; background: #f9f9f9; border-radius: 8px;">
            <form action="{{ route('admin.returns') }}" method="GET"
                style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
                
                <!-- Input Pencarian Nama User / Buku -->
                <div class="filter-group"
                    style="display: flex; flex-direction: column; gap: 5px; flex-grow: 1; min-width: 200px;">
                    <input type="text" name="search" placeholder="Cari nama anggota atau judul buku..."
                        value="{{ request('search') }}"
                        style="padding: 8px 10px; border: 1px solid #ddd; border-radius: 4px; width: 100%;">
                </div>

                <!-- Input Filter Tanggal Awal -->
                <div class="filter-group" style="display: flex; flex-direction: column; gap: 5px;">
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; min-width: 140px;"
                        title="Tanggal Mulai">
                </div>

                <div style="align-self: center; padding-bottom: 8px; color: #888;">s/d</div>

                <!-- Input Filter Tanggal Akhir -->
                <div class="filter-group" style="display: flex; flex-direction: column; gap: 5px;">
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; min-width: 140px;"
                        title="Tanggal Selesai">
                </div>

                <!-- Dropdown Filter Status Kembali -->
                <div class="filter-group" style="display: flex; flex-direction: column; gap: 5px;">
                    <select name="status"
                        style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; min-width: 130px;">
                        <option value="">Semua Status</option>
                        <option value="kembali" {{ request('status') == 'kembali' ? 'selected' : '' }}>Kembali</option>
                        <option value="terlambat" {{ request('status') == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <!-- Tombol Submit & Reset -->
                <div style="display: flex; gap: 10px;">
                    <button type="submit"
                        style="padding: 8px 15px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
                        Cari & Filter
                    </button>
                    @if (request('search') || request('status') || request('start_date') || request('end_date'))
                        <a href="{{ route('admin.returns') }}"
                            style="padding: 8px 12px; background: #e0e0e0; border-radius: 4px; color: #333; text-decoration: none; font-size: 0.85rem;">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- TABEL DATA -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Buku</th>
                    <th>Tanggal Kembali</th>
                    <th>Keterlambatan</th>
                    <th>Denda</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($returns as $return)
                    <tr>
                        <td>#RT{{ sprintf('%04d', $return->id) }}</td>
                        <td>{{ $return->user->name ?? 'User Terhapus' }}</td>
                        <td>{{ $return->book->title ?? 'Buku Terhapus' }}</td>
                        <td>{{ $return->returned_at ? $return->returned_at->format('d M Y') : '-' }}</td>
                        <td>
                            @if($return->late_days > 0)
                                {{ $return->late_days }} Hari
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($return->fine > 0)
                                Rp{{ number_format($return->fine, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($return->status === 'kembali')
                                <span class="badge success">Kembali</span>
                            @elseif($return->status === 'terlambat')
                                <span class="badge danger">Terlambat</span>
                            @else
                                <span class="badge warning">Pending</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.returns.destroy', $return->id) }}" method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat pengembalian ini?')">
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
                        <td colspan="8" style="text-align: center; color: #888; padding: 20px;">Data pengembalian tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Link Pagination Laravel -->
        <div class="pagination">
            {{ $returns->links() }}
        </div>
    </div>

    <!-- ==================== MODAL TAMBAH PENGEMBALIAN ==================== -->
    <div id="returnModal"
        style="display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
        <div style="background: white; padding: 25px; border-radius: 8px; width: 450px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            <h3 style="margin-top: 0; margin-bottom: 20px;">Tambah Transaksi Pengembalian</h3>

            <form action="{{ route('admin.returns.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Pilih Transaksi Peminjaman Aktif</label>
                    <select name="loan_id" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">-- Pilih Anggota & Buku --</option>
                        @foreach($activeLoans as $loan)
                            <option value="{{ $loan->id }}">
                                {{ $loan->user->name }} - {{ $loan->book->title }} (Deadline: {{ \Carbon\Carbon::parse($loan->due_at)->format('d/m/Y') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Tanggal Dikembalikan</label>
                    <input type="date" name="returned_at" value="{{ date('Y-m-d') }}" required
                        style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Kondisi Buku</label>
                    <select name="condition" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="baik">Baik / Normal</option>
                        <option value="rusak">Rusak (+ Denda Rp50.000)</option>
                        <option value="hilang">Hilang (+ Denda Rp150.000)</option>
                    </select>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" onclick="closeModal()"
                        style="padding: 8px 15px; background: #e0e0e0; border: none; border-radius: 4px; cursor: pointer;">Batal</button>
                    <button type="submit"
                        style="padding: 8px 15px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Proses Kembali</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('returnModal');

        function openAddModal() {
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