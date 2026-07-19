<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Fine;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanUserController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Ambil data peminjaman yang masih aktif berjalan
        $activeLoans = Loan::with('book')
            ->where('user_id', $userId)
            ->where('status', 'dipinjam')
            ->get();

        // 2. Ambil riwayat peminjaman yang sudah dikembalikan
        $returnedHistory = Loan::with('book')
            ->where('user_id', $userId)
            ->where('status', 'selesai')
            ->latest()
            ->take(4)
            ->get();
        
        foreach ($returnedHistory as $loan) {
            $fine = Fine::where('user_id', Auth::id())
                ->where('book_id', $loan->book_id)
                ->first();
            $loan->checkFine = $fine ? $fine->status : 'paid';
        }

        // 3. Kalkulasi data counter statistik dashboard peminjaman
        $borrowingCount = $activeLoans->count();
        $returnedCount = Loan::where('user_id', $userId)->where('status', 'selesai')->count();
        
        // Cek peminjaman aktif mana yang tanggal deadlinenya sudah terlewati
        $overdueCount = $activeLoans->filter(function($loan) {
            return Carbon::parse($loan->due_at)->isPast();
        })->count();

        return view('member.loans', compact(
            'activeLoans', 
            'returnedHistory', 
            'borrowingCount', 
            'returnedCount', 
            'overdueCount'
        ));
    }

    // Aksi Perpanjang Buku (Menambah batas pengembalian buku + 7 Hari)
    public function extend($id)
    {
        $loan = Loan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Pastikan buku belum terlambat untuk diperpanjang
        if (Carbon::parse($loan->due_at)->isPast()) {
            return redirect()->back()->with('error', 'Buku yang sudah terlambat tidak dapat diperpanjang secara mandiri.');
        }

        // Tambahkan durasi deadline 7 hari lagi
        $loan->due_at = Carbon::parse($loan->due_at)->addDays(7);
        $loan->save();

        return redirect()->back()->with('success', 'Masa peminjaman buku berhasil diperpanjang 7 hari!');
    }
}
