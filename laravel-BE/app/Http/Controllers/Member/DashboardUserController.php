<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Fine;
use App\Models\Loan;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class DashboardUserController extends Controller
{
    public function index()
    {
        // Ambil 5 kategori pertama
        $categories = Category::take(5)->get();

        // Ambil 4 buku teratas
        $popularBooks = Book::latest()->take(4)->get();

        // Ambil riwayat peminjaman user saat ini
        $borrowLogs = Loan::with('book')
            ->where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();
        foreach ($borrowLogs as $log) {
            $fine = Fine::where('user_id', Auth::id())
                ->where('book_id', $log->book_id)
                ->first();
            $log->checkFine = $fine ? $fine->status : 'paid';
        }

        return view('member.dashboard', compact('categories', 'popularBooks', 'borrowLogs'));
    }

    public function pinjamBuku($id)
    {
        $book = Book::findOrFail($id);

        // 1. Validasi: Apakah stok buku masih ada?
        if ($book->available_copies <= 0) {
            return redirect()->back()->with('error', 'Maaf, stok buku ini sudah habis!');
        }

        // 2. Validasi Opsional: Apakah user sedang meminjam buku ini dan belum dikembalikan?
        $isAlreadyBorrowed = Loan::where('user_id', Auth::id())
            ->where('book_id', $id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($isAlreadyBorrowed) {
            return redirect()->back()->with('error', 'Anda masih meminjam buku ini!');
        }

        // 3. Kurangi stok buku
        $book->decrement('available_copies');

        $whishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('book_id', $id)
            ->first();
        if ($whishlistItem) {
            $whishlistItem->delete();
        }

        // 4. Buat riwayat peminjaman baru
        Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $id,
            'loaned_at' => Carbon::now(),
            'due_at' => Carbon::now()->addDays(7), // Durasi pinjam standar: 7 hari
            'status' => 'dipinjam',
        ]);


        return redirect()->back()->with('success', 'Buku "' . $book->title . '" berhasil dipinjam!');
    }

    public function downloadLaporan()
    {
        $user = Auth::user();
        
        // Ambil semua riwayat milik user yang sedang login beserta relasi bukunya
        $borrowLogs = Loan::with('book')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($borrowLogs as $log) {
            $fine = Fine::where('user_id', $user->id)
                ->where('book_id', $log->book_id)
                ->first();
            $log->checkFine = $fine ? $fine->status : 'paid';
        }
        // Load view khusus untuk cetak PDF, kirimkan data logs dan user
        $pdf = PDF::loadView('member.laporan-pdf', compact('borrowLogs', 'user'));

        // Download file PDF dengan nama unik
        return $pdf->download('Laporan_Peminjaman_' . str_replace(' ', '_', $user->name) . '.pdf');
    }
}
