<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Loan::with(['user', 'book']);

        if ($request->has('search') && $request->search != '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // Filter Rentang Tanggal Pinjam (loaned_at)
        if ($request->filled('start_date')) {
            $query->whereDate('loaned_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('loaned_at', '<=', $request->end_date);
        }

        // Filter Status Peminjaman (dipinjam, selesai, terlambat)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $loans = $query->latest()->paginate(10)->withQueryString();
        
        // Ambil data user (member) dan buku untuk dropdown di Modal Form
        $users = User::where('role', 'member')->get();
        // Hanya buku yang stoknya masih tersedia yang bisa dipinjam
        $books = Book::where('available_copies', '>', 0)->get();

        return view('admin.peminjaman', compact('loans', 'users', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'loaned_at' => 'required|date',
            'due_at' => 'required|date|after_or_equal:loaned_at',
            'notes' => 'nullable|string',
        ]);

        // Cek kembali ketersediaan buku
        $book = Book::find($request->book_id);
        if ($book->available_copies <= 0) {
            return redirect()->back()->with('error', 'Stok buku ini sedang habis!');
        }

        // Simpan transaksi peminjaman (status default: 'active')
        Loan::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'loaned_at' => $request->loaned_at,
            'due_at' => $request->due_at,
            'status' => 'dipinjam',
            'notes' => $request->notes,
        ]);

        // Kurangi stok buku yang tersedia
        $book->decrement('available_copies');

        return redirect()->route('admin.loans')->with('success', 'Peminjaman berhasil dicatat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:dipinjam,selesai,terlambat',
            'notes' => 'nullable|string',
        ]);

        $oldStatus = $loan->status;
        $newStatus = $request->status;

        $loan->update([
            'status' => $newStatus,
            'notes' => $request->notes,
            'returned_at' => $newStatus === 'selesai' ? Carbon::now() : $loan->returned_at,
        ]);

        if ($newStatus === 'selesai' && $oldStatus !== 'selesai') {
            Book::find($loan->book_id)->increment('available_copies');
        } 
        elseif ($oldStatus === 'selesai' && $newStatus !== 'selesai') {
            Book::find($loan->book_id)->decrement('available_copies');
        }

        return redirect()->route('admin.loans')->with('success', 'Data peminjaman berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);

        // Jika buku belum dikembalikan saat data dihapus, kembalikan stok kuotanya dahulu
        if ($loan->status !== 'selesai') { 
            Book::find($loan->book_id)->increment('available_copies');
        }

        $loan->delete();

        return redirect()->route('admin.loans')->with('success', 'Data peminjaman berhasil dihapus!');
    }
}
