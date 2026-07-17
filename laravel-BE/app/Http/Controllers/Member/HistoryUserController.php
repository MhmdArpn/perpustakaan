<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryUserController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Mengambil seluruh riwayat transaksi peminjaman (baik aktif maupun kembali)
        // Dipaginasi per 10 data
        $loans = Loan::with('book')
            ->where('user_id', $userId)
            ->latest()
            ->paginate(10);

        // Kalkulasi Statistik Ringkasan
        $totalBorrowed = Loan::where('user_id', $userId)->count();
        $returnedCount = Loan::where('user_id', $userId)->where('status', 'dikembalikan')->count();
        
        // Peminjaman aktif yang tanggal deadlinenya sudah lewat dari hari ini
        $overdueCount = Loan::where('user_id', $userId)
            ->where('status', 'dipinjam')
            ->where('due_at', '<', Carbon::now())
            ->count();

        return view('member.history', compact('loans', 'totalBorrowed', 'returnedCount', 'overdueCount'));
    }
}
