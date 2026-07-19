<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookSearchController extends Controller
{
    public function index()
    {
        // Ambil seluruh buku beserta relasi kategorinya
        $books = Book::with('category')->get();

        // Ambil seluruh list kategori untuk dropdown filter
        $categories = Category::all();

        foreach ($books as $book) {
            $loan = $book->loans()->where('status', 'dipinjam')->where('user_id', Auth::user()->id)->first();
            $book->pinjam = $loan;
        }

        return view('member.search', compact('books', 'categories'));
    }
}
