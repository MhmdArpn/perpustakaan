<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Fine;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Data pendukung untuk Modal Form
        $users = User::where('role', 'member')->get();
        $books = Book::all();

        // Query Utama
        $query = Fine::with(['user', 'book']);

        // Fitur Pencarian Nama Anggota / Judul Buku
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('book', function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        $fines = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // Kalkulasi Kartu Statistik
        $totalDenda = Fine::sum('amount');
        $belumBayar = Fine::where('status', 'unpaid')->count();
        $lunas = Fine::where('status', 'paid')->count();
        $bulanIni = Fine::whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year)
                        ->sum('amount');

        return view('admin.denda', compact('fines', 'users', 'books', 'totalDenda', 'belumBayar', 'lunas', 'bulanIni'));
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
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:unpaid,paid',
            'late_days' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        Fine::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'amount' => $request->amount,
            'status' => $request->status,
            'late_days' => $request->late_days ?? 0,
            'notes' => $request->notes,
        ]);
        
        $today = Carbon::today()->toDateString();
        $totalDendaHariIni = Fine::whereDate('created_at', $today)->sum('amount');

        Report::updateOrCreate(
            [
                'type' => 'denda',
                'report_date' => $today,
            ],
            [
                'total_summary' => 'Rp ' . number_format($totalDendaHariIni, 0, ',', '.'),
                'status' => 'selesai'
            ]
        );

        return redirect()->route('admin.fines')->with('success', 'Data denda baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fine $fine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fine $fine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $fine = Fine::findOrFail($id);

        $request->validate([
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:unpaid,paid',
            'notes' => 'nullable|string',
        ]);

        $fine->update([
            'amount' => $request->amount,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);
        $fineDate = Carbon::parse($fine->created_at)->toDateString();
        $totalDendaTanggalTersebut = Fine::whereDate('created_at', $fineDate)->sum('amount');

        Report::updateOrCreate(
            [
                'type' => 'denda',
                'report_date' => $fineDate,
            ],
            [
                'total_summary' => 'Rp ' . number_format($totalDendaTanggalTersebut, 0, ',', '.'),
                'status' => 'selesai'
            ]
        );

        return redirect()->route('admin.fines')->with('success', 'Data denda berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fine = Fine::findOrFail($id);
        $fine->delete();

        return redirect()->route('admin.fines')->with('success', 'Data denda berhasil dihapus.');
    }
}
