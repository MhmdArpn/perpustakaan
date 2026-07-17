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
}
