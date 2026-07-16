<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Fine;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $totalBuku = Book::sum('total_copies');
        $totalPeminjamanAktif = Loan::where('status', 'dipinjam')->count();
        $totalMember = User::where('role', 'member')->count();
        $totalDendaBelumDibayar = Fine::where('status', 'unpaid')->sum('amount');
        $recentActivities = Loan::with(['user', 'book'])
        ->where('created_at', '>=', Carbon::now()->subDay()) 
        ->orderBy('created_at', 'desc')
        ->take(10) // Batasi maksimal 10 aktivitas terbaru
        ->get();

    return view('admin.dashboard', compact(
        'totalBuku', 
        'totalPeminjamanAktif', 
        'totalMember', 
        'totalDendaBelumDibayar',
        'recentActivities'
    ));
    }
}
