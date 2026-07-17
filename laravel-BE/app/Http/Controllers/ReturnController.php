<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Report;
use App\Models\ReturnBook;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil data peminjaman yang berstatus 'dipinjam' atau 'terlambat' untuk dropdown di Modal Tambah
        $activeLoans = Loan::whereIn('status', ['dipinjam', 'terlambat'])->with(['user', 'book'])->get();

        // Query data pengembalian dengan Eager Loading relasi user dan book
        $query = ReturnBook::with(['user', 'book']);

        // Filter: Pencarian (Nama User atau Judul Buku)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('book', function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        // Filter: Rentang Tanggal Kembali
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('returned_at', [$request->start_date, $request->end_date]);
        }

        // Filter: Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Urutkan dari data terbaru
        $returns = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // Menghitung data ringkasan untuk kartu statistik (Cards)
        $totalKembali = ReturnBook::count();
        $hariIni = ReturnBook::whereDate('returned_at', Carbon::today())->count();
        $totalTerlambat = ReturnBook::where('status', 'terlambat')->count();
        $totalDenda = ReturnBook::sum('fine');

        return view('admin.pengembalian', compact(
            'returns', 'activeLoans', 'totalKembali', 'hariIni', 'totalTerlambat', 'totalDenda'
        ));
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
            'loan_id' => 'required|exists:loans,id',
            'returned_at' => 'required|date',
            'condition' => 'required|in:baik,rusak,hilang',
        ]);

        // Ambil data peminjaman aslinya
        $loan = Loan::findOrFail($request->loan_id);
        
        $returnedAt = Carbon::parse($request->returned_at);
        $dueAt = Carbon::parse($loan->due_at);
        
        $lateDays = 0;
        $fine = 0;
        $status = 'kembali';

        // Logika Hitung Keterlambatan & Denda
        if ($returnedAt->gt($dueAt)) {
            $lateDays = $returnedAt->diffInDays($dueAt);
            $fine = $lateDays * 5000; 
            $status = 'terlambat';
        }

        // Logika Tambahan: Denda berdasarkan kondisi buku
        if ($request->condition === 'rusak') {
            $fine += 50000; // Tambah denda rusak Rp 50.000
        } elseif ($request->condition === 'hilang') {
            $fine += 150000; // Tambah denda hilang Rp 150.000
        }

        // Simpan ke tabel returns
        ReturnBook::create([
            'loan_id' => $loan->id,
            'user_id' => $loan->user_id,
            'book_id' => $loan->book_id,
            'returned_at' => $returnedAt,
            'late_days' => $lateDays,
            'fine' => $fine,
            'status' => $status,
            'condition' => $request->condition
        ]);

        // Update status di tabel peminjaman (loans) menjadi 'selesai'
        $loan->update(['status' => 'selesai']);

        // Kembalikan/tambahkan stok buku di tabel books (+1)
        $loan->book->increment('available_copies');
        
        // Atur status buku kembali menjadi 'available' jika sebelumnya ditandai dipinjam
        if ($loan->book->status === 'borrowed' && $loan->book->available_copies > 0) {
            $loan->book->update(['status' => 'available']);
        }
        $today = Carbon::today()->toDateString();
    
        $totalKembaliHariIni = ReturnBook::whereDate('returned_at', $today)->count();

        Report::updateOrCreate(
            [
                'type' => 'pengembalian',
                'report_date' => $today,
            ],
            [
                'total_summary' => $totalKembaliHariIni . ' Buku Dikembalikan',
                'status' => 'selesai'
            ]
        );

        return redirect()->route('admin.returns')->with('success', 'Transaksi pengembalian berhasil diproses dan stok buku telah diperbarui!');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $returnBook = ReturnBook::findOrFail($id);
        $returnBook->delete();

        return redirect()->route('admin.returns')->with('success', 'Data pengembalian berhasil dihapus.');
    }
}
