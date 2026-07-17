<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanUserController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $statusFilter = $request->get('status');

        $query = Loan::with('book')->where('user_id', $userId);

        if ($statusFilter && $statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        }

        $loans = $query->orderBy('created_at', 'desc')->get();

        // Statistik ringkas berdasarkan status Anda
        $totalBorrowed = Loan::where('user_id', $userId)->count();
        $activeLoanCount = Loan::where('user_id', $userId)->where('status', 'dipinjam')->count();
        $overdueCount = Loan::where('user_id', $userId)
            ->where('status', 'dipinjam')
            ->where('due_at', '<', now())
            ->count();

        return view('member.reports', compact('loans', 'totalBorrowed', 'activeLoanCount', 'overdueCount'));
    }

    // 2. PROSES PINJAM BUKU LANGSUNG
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $userId = Auth::id();
        $book = Book::findOrFail($request->book_id);

        // Cek stok buku
        if ($book->qty <= 0) {
            return redirect()->back()->with('error', 'Maaf, stok buku ini sedang kosong!');
        }

        // Cek apakah user sedang meminjam buku yang sama
        $existingLoan = Loan::where('user_id', $userId)
            ->where('book_id', $book->id)
            ->where('status', 'dipinjam')
            ->first();

        if ($existingLoan) {
            return redirect()->back()->with('error', 'Anda sedang meminjam buku ini!');
        }

        // Buat peminjaman baru (Durasi pinjam: 7 hari)
        Loan::create([
            'user_id' => $userId,
            'book_id' => $book->id,
            'loaned_at' => Carbon::now()->toDateString(),
            'due_at' => Carbon::now()->addDays(7)->toDateString(),
            'status' => 'dipinjam',
            'notes' => 'Peminjaman mandiri via aplikasi.'
        ]);

        // Kurangi stok buku
        $book->decrement('qty');

        return redirect()->back()->with('success', 'Buku berhasil dipinjam! Silakan ambil fisik buku di meja pustakawan.');
    }

    // 3. PROSES PENGEMBALIAN BUKU (MEMBER)
    public function returnBook($id)
    {
        $loan = Loan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($loan->status === 'dipinjam') {
            $today = Carbon::now();
            $status = 'selesai';
            $noteMessage = 'Dikembalikan tepat waktu.';

            // Evaluasi keterlambatan secara dinamis
            if ($today->gt($loan->due_at)) {
                $status = 'terlambat';
                $hariTerlambat = $today->diffInDays($loan->due_at);
                $noteMessage = "Terlambat mengembalikan selama {$hariTerlambat} hari.";
            }

            $loan->update([
                'status' => $status,
                'returned_at' => $today->toDateString(),
                'notes' => $noteMessage
            ]);

            // Kembalikan stok buku
            $loan->book->increment('qty');

            return redirect()->back()->with('success', 'Buku berhasil dikembalikan! ' . ($status === 'terlambat' ? $noteMessage : 'Terima kasih telah mengembalikan tepat waktu.'));
        }

        return redirect()->back()->with('error', 'Buku ini sudah dikembalikan sebelumnya.');
    }
}
