@extends('layouts.layout-admin')

@section('title', 'Laporan Analitik')
@section('page-title')
    <h1>Laporan</h1>
    <p>Kelola dan cetak laporan resmi perpustakaan</p>
@endsection

@section('content')
    <!-- STATISTIC CARDS -->
    <div class="cards">
        <div class="card"><div class="card-info"><p>Total Unduhan</p><h2>{{ $totalLaporan }}</h2></div><i class="fa-solid fa-file"></i></div>
        <div class="card"><div class="card-info"><p>Total Peminjaman</p><h2>{{ $peminjaman }}</h2></div><i class="fa-solid fa-book-open-reader"></i></div>
        <div class="card"><div class="card-info"><p>Total Pengembalian</p><h2>{{ $pengembalian }}</h2></div><i class="fa-solid fa-arrow-rotate-left"></i></div>
        <div class="card"><div class="card-info"><p>Total Kas Denda</p><h2>Rp{{ number_format($totalDenda, 0, ',', '.') }}</h2></div><i class="fa-solid fa-money-bill-wave"></i></div>
    </div>

    <!-- MAIN CONTAINER -->
    <div class="table-card" style="margin-top: 20px;">
        <div class="table-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3>Daftar Log Pembuatan Laporan Berkas</h3>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jenis Laporan</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Item / Nominal</th>
                    <th>Status Berkas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>#LP{{ sprintf('%03d', $report->id) }}</td>
                        <td><strong>{{ ucfirst($report->type) }}</strong></td>
                        <td>{{ \Carbon\Carbon::parse($report->report_date)->format('d F Y') }}</td>
                        <td>{{ $report->total_summary }}</td>
                        <td><span class="badge success">{{ ucfirst($report->status) }}</span></td>
                        <td>
                            <a href="{{ route('admin.reports.export', $report->id) }}" style="color: #27ae60; font-size: 1rem;">
                                <i class="fa-solid fa-download"></i> Unduh PDF
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">{{ $reports->links() }}</div>
    </div>
@endsection