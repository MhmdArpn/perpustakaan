@extends('layouts.layout-admin')

@section('title', 'Kelola Member')

@section('page-title')
    <h1>Member</h1>
    <p>Kelola data anggota perpustakaan</p>
@endsection

@section('content')
    <style>
        .badge.premium { background-color: #f39c12; color: white; }
        .badge.regular { background-color: #7f8c8d; color: white; }
    </style>

    <!-- STATISTIC CARDS -->
    <div class="cards">
        <div class="card">
            <div>
                <p>Total Member</p>
                <h2>{{ number_format($totalMember, 0, ',', '.') }}</h2>
            </div>
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="card">
            <div>
                <p>Aktif</p>
                <h2>{{ number_format($aktif, 0, ',', '.') }}</h2>
            </div>
            <i class="fa-solid fa-user-check"></i>
        </div>
        <div class="card">
            <div>
                <p>Baru Bulan Ini</p>
                <h2>{{ number_format($baruBulanIni, 0, ',', '.') }}</h2>
            </div>
            <i class="fa-solid fa-user-plus"></i>
        </div>
        <div class="card">
            <div>
                <p>Premium</p>
                <h2>{{ number_format($premium, 0, ',', '.') }}</h2>
            </div>
            <i class="fa-solid fa-crown"></i>
        </div>
    </div>

    <!-- MAIN TABLE & ACTION CONTAINER -->
    <div class="table-card" style="margin-top: 20px;">
        
        @if (session('success'))
            <div style="padding: 12px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3>Daftar Member</h3>
            
            <!-- Integrasi Pencarian -->
            <div style="display: flex; gap: 10px; align-items: center;">
                <form action="{{ route('admin.members') }}" method="GET" style="display: flex; gap: 5px;">
                    <input type="text" name="search" placeholder="Cari member..." value="{{ request('search') }}"
                        style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; min-width: 200px;">
                    <button type="submit" style="padding: 8px 12px; background: #555; color: white; border: none; border-radius: 4px; cursor: pointer;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.members') }}" style="padding: 8px 12px; background: #eee; color: #333; border-radius: 4px; text-decoration: none; font-size: 0.85rem;">Reset</a>
                    @endif
                </form>
                
                <button onclick="openAddModal()">
                    <i class="fa-solid fa-plus"></i> Tambah Member
                </button>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Tipe</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                    <tr>
                        <td>MB{{ sprintf('%03d', $member->id) }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->phone ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $member->membership_type }}">
                                {{ ucfirst($member->membership_type) }}
                            </span>
                        </td>
                        <td>
                            @if($member->status === 'active')
                                <span class="badge success">Aktif</span>
                            @elseif($member->status === 'pending')
                                <span class="badge warning">Pending</span>
                            @else
                                <span class="badge danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <i class="fa-solid fa-pen-to-square edit" style="cursor: pointer; margin-right: 10px; color: #3498db;"
                               onclick="openEditModal({{ json_encode($member) }})"></i>
                            
                            <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" style="display: inline;"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus member ini?')">
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
                        <td colspan="7" style="text-align: center; color: #888; padding: 20px;">Data member tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $members->links() }}
        </div>
    </div>

    <!-- ==================== MODAL TAMBAH MEMBER ==================== -->
    <div id="addModal" style="display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
        <div style="background: white; padding: 25px; border-radius: 8px; width: 450px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            <h3 style="margin-top: 0; margin-bottom: 20px;">Tambah Member Baru</h3>
            <form action="{{ route('admin.members.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nama Lengkap</label>
                    <input type="text" name="name" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Email</label>
                    <input type="email" name="email" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nomor Telepon</label>
                    <input type="text" name="phone" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Password Awal</label>
                    <input type="password" name="password" required placeholder="Min 6 karakter" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 12px; display: flex; gap: 15px;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Tipe</label>
                        <select name="membership_type" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="regular">Regular</option>
                            <option value="premium">Premium</option>
                        </select>
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Status</label>
                        <select name="status" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                    <button type="button" onclick="closeAddModal()" style="padding: 8px 15px; background: #e0e0e0; border: none; border-radius: 4px; cursor: pointer;">Batal</button>
                    <button type="submit" style="padding: 8px 15px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== MODAL EDIT MEMBER ==================== -->
    <div id="editModal" style="display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
        <div style="background: white; padding: 25px; border-radius: 8px; width: 450px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            <h3 style="margin-top: 0; margin-bottom: 20px;">Ubah Data Member</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nama Lengkap</label>
                    <input type="text" name="name" id="edit_name" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Email</label>
                    <input type="email" name="email" id="edit_email" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nomor Telepon</label>
                    <input type="text" name="phone" id="edit_phone" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Ganti Password (Opsional)</label>
                    <input type="password" name="password" placeholder="Kosongkan jika tidak ingin diubah" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 12px; display: flex; gap: 15px;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Tipe</label>
                        <select name="membership_type" id="edit_membership_type" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="regular">Regular</option>
                            <option value="premium">Premium</option>
                        </select>
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Status</label>
                        <select name="status" id="edit_status" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                    <button type="button" onclick="closeEditModal()" style="padding: 8px 15px; background: #e0e0e0; border: none; border-radius: 4px; cursor: pointer;">Batal</button>
                    <button type="submit" style="padding: 8px 15px; background: #3498db; color: white; border: none; border-radius: 4px; cursor: pointer;">Perbarui</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT MODAL LOGIC -->
    <script>
        const addModal = document.getElementById('addModal');
        const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');

        function openAddModal() { addModal.style.display = "flex"; }
        function closeAddModal() { addModal.style.display = "none"; }

        function openEditModal(member) {
            // Set data ke dalam input form edit secara dinamis
            document.getElementById('edit_name').value = member.name;
            document.getElementById('edit_email').value = member.email;
            document.getElementById('edit_phone').value = member.phone || '';
            document.getElementById('edit_membership_type').value = member.membership_type;
            document.getElementById('edit_status').value = member.status;
            
            // Set rute action form secara dinamis ke target ID member
            editForm.action = `/admin/member/${member.id}`;
            
            editModal.style.display = "flex";
        }
        function closeEditModal() { editModal.style.display = "none"; }

        window.onclick = function(event) {
            if (event.target == addModal) closeAddModal();
            if (event.target == editModal) closeEditModal();
        }
    </script>
@endsection