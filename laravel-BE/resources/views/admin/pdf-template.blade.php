<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Resmi Perpustakaan</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #333; line-height: 1.4; font-size: 12px; }
        .kop-surat { text-align: center; margin-bottom: 20px; border-bottom: 3px double #000; padding-bottom: 10px; }
        .kop-surat h2 { margin: 0; font-size: 20px; text-transform: uppercase; color: #2c3e50; }
        .kop-surat p { margin: 4px 0 0 0; color: #7f8c8d; font-size: 11px; }
        .info-laporan { margin-bottom: 20px; width: 100%; }
        .info-laporan td { padding: 4px 0; }
        .table-data { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .table-data th { background-color: #2c3e50; color: white; padding: 8px; text-align: left; font-size: 11px; }
        .table-data td { padding: 8px; border: 1px solid #bdc3c7; }
        .table-data tr:nth-child(even) { background-color: #f8f9fa; }
        .ttd-container { margin-top: 50px; float: right; text-align: center; width: 200px; }
        .ttd-space { height: 70px; }
    </style>
</head>
<body>

    <!-- KOP SURAT PERPUSTAKAAN -->
    <div class="kop-surat">
        <h2>Perpustakaan Digital Utama</h2>
        <p>Jl. Peminjaman Raya No. 45, Komplek Edukasi | Telp: (021) 889923</p>
        <p><strong>BERKAS DOKUMEN LAPORAN EKSPOR RESMI</strong></p>
    </div>

    <!-- RINGKASAN DATA -->
    <table class="info-laporan">
        <tr>
            <td style="width: 15%;"><strong>ID Dokumen</strong></td>
            <td style="width: 35%;">: #LP00{{ $report->id }}</td>
            <td style="width: 20%;"><strong>Tanggal Cetak</strong></td>
            <td style="width: 30%;">: {{ date('d F Y') }}</td>
        </tr>
        <tr>
            <td><strong>Jenis Laporan</strong></td>
            <td>: {{ ucfirst($report->type) }}</td>
            <td><strong>Periode Data</strong></td>
            <td>: {{ \Carbon\Carbon::parse($report->report_date)->format('d M Y') }}</td>
        </tr>
    </table>

    <p>Berdasarkan pencatatan data pada sistem inti, berikut adalah daftar entri transaksi terkini:</p>

    <!-- DATA TABEL UTAMA -->
    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 30%;">Nama Anggota</th>
                <th style="width: 40%;">Judul Buku</th>
                <th style="width: 25%;">Keterangan Tambahan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->user->name ?? 'User Terhapus' }}</td>
                    <td>{{ $item->book->title ?? 'Buku Terhapus' }}</td>
                    <td>
                        @if($report->type === 'peminjaman')
                            Tgl Pinjam: {{ $item->created_at->format('d F Y') }}
                        @elseif($report->type === 'pengembalian')
                            Kondisi: {{ ucfirst($item->condition) }}
                        @else
                            Denda: Rp{{ number_format($item->amount, 0, ',', '.') }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- TANDA TANGAN (SIGNATURE BLOCK) -->
    <div class="ttd-container">
        <p>Jakarta, {{ date('d F Y') }}</p>
        <p><strong>Kepala Pustakawan,</strong></p>
        <div class="ttd-space"></div>
        <p style="border-bottom: 1px solid #000; padding-bottom: 2px;"><strong>Administrator Utama</strong></p>
        <p style="font-size: 10px; color:#555;">NIP. 199308129381</p>
    </div>

</body>
</html>