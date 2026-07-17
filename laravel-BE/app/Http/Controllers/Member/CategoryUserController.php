<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryUserController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori dan menghitung berapa banyak buku di dalamnya
        $categories = Category::withCount('books')->get();

        // Mengambil semua buku beserta relasi kategorinya
        $books = Book::with('category')->get();

        return view('member.categories', compact('categories', 'books'));
    }
}
