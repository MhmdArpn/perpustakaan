<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookSearchController extends Controller
{
    public function index()
    {
        // Ambil seluruh buku beserta relasi kategorinya
        $books = Book::with('category')->get();

        // Ambil seluruh list kategori untuk dropdown filter
        $categories = Category::all();

        return view('member.search', compact('books', 'categories'));
    }
}
