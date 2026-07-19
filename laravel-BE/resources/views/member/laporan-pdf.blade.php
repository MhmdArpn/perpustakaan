<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 10px; color: white; font-weight: bold; }
        .success { background-color: #2ecc71; }
        .info-badge { background-color: #3498db; }
        .danger { background-color: #e74c3c; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN RIWAYAT PEMINJAMAN BUKU</h2>
        <h3>Sistem Perpustakaan Digital</h3>
    </div>

    <div class="info">
        <p><strong>Nama Anggota:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d M Y H:i') }} WIB</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Batas Pengembalian</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowLogs as $index => $log)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $log->book->title ?? 'Buku Telah Dihapus' }}</td>
                    <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($log->due_at)->format('d M Y') }}</td>
                    <td>
                        @if($log->status == 'dipinjam')
                            @if(\Carbon\Carbon::parse($log->due_at)->isPast())
                                Terlambat
                            @else
                                Dipinjam
                            @endif
                        @elseif($log->status == 'selesai')
                            @if($log->checkFine == 'unpaid')
                                Dikembalikan | Denda Belum Dibayar
                            @else
                                Dikembalikan
                            @endif
                        @else
                            Terlambat
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Belum ada riwayat peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>