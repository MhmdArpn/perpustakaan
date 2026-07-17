<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('member.dashboard', compact('categories', 'popularBooks', 'borrowLogs'));
    }

    public function pinjamBuku($id)
    {
        $book = Book::findOrFail($id);

        // 1. Validasi: Apakah stok buku masih ada?
        if ($book->qty <= 0) {
            return redirect()->back()->with('error', 'Maaf, stok buku ini sudah habis!');
        }

        // 2. Validasi Opsional: Apakah user sedang meminjam buku ini dan belum dikembalikan?
        $isAlreadyBorrowed = BorrowLog::where('user_id', Auth::id())
            ->where('book_id', $id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($isAlreadyBorrowed) {
            return redirect()->back()->with('error', 'Anda masih meminjam buku ini!');
        }

        // 3. Kurangi stok buku
        $book->decrement('qty');

        // 4. Buat riwayat peminjaman baru
        BorrowLog::create([
            'user_id' => Auth::id(),
            'book_id' => $id,
            'created_at' => Carbon::now(),
            'due_at' => Carbon::now()->addDays(7), // Durasi pinjam standar: 7 hari
            'status' => 'dipinjam',
        ]);

        return redirect()->back()->with('success', 'Buku "' . $book->title . '" berhasil dipinjam!');
    }
}
