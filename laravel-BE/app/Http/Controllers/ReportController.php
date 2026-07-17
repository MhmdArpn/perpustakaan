<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\Loan;
use App\Models\Report;
use App\Models\ReturnBook;
use PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::orderBy('report_date', 'desc')->paginate(10);

        // Menghitung ringkasan statistik untuk Cards admin
        $totalLaporan = Report::count();
        $peminjaman = Loan::count();
        $pengembalian = ReturnBook::count();
        $totalDenda = Fine::sum('amount');

        return view('admin.laporan', compact('reports', 'totalLaporan', 'peminjaman', 'pengembalian', 'totalDenda'));
    }

    public function exportPdf($id)
    {
        $reportLog = Report::findOrFail($id);
        
        // Ambil rincian data transaksi berdasarkan jenis laporan
        $data = [];
        if ($reportLog->type === 'peminjaman') {
            $data = Loan::with(['user', 'book'])->whereDate('created_at', $reportLog->report_date)->get();
        } elseif ($reportLog->type === 'pengembalian') {
            $data = ReturnBook::with(['user', 'book'])->whereDate('returned_at', $reportLog->report_date)->get();
        } else {
            $data = Fine::with(['user', 'book'])->whereDate('created_at', $reportLog->report_date)->get();
        }

        // Generate PDF menggunakan view khusus cetak
        $pdf = PDF::loadView('admin.pdf-template', [
            'report' => $reportLog,
            'details' => $data
        ])->setPaper('a4', 'portrait');

        return $pdf->download('Laporan_' . ucfirst($reportLog->type) . '_' . $reportLog->report_date->format('d_M_Y') . '.pdf');
    }
}
