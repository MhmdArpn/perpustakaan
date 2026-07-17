<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistUserController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Ambil data wishlist milik user yang sedang login beserta relasi buku dan kategorinya
        $wishlists = Wishlist::with(['book.category'])
            ->where('user_id', $userId)
            ->get();

        // 2. Ambil semua kategori untuk kebutuhan dropdown filter
        $categories = Category::all();

        // 3. Hitung statistik kartu ringkasan
        $wishlistCount = $wishlists->count();
        $availableCount = $wishlists->filter(function($w) {
            return ($w->book->qty ?? 0) > 0;
        })->count();
        $borrowedCount = $wishlistCount - $availableCount;

        return view('member.wishlist', compact('wishlists', 'categories', 'wishlistCount', 'availableCount', 'borrowedCount'));
    }

    // Menghapus item dari daftar wishlist
    public function destroy($id)
    {
        $wishlist = Wishlist::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $wishlist->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus dari daftar wishlist!');
    }
}
