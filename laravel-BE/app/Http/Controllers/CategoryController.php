<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Hitung Statistik Dinamis
        $totalKategori = Category::count();
        $kategoriAktif = Category::where('is_active', true)->count();
        
        // Menghitung kategori baru yang dibuat dalam 7 hari terakhir
        $baruDitambahkan = Category::where('created_at', '>=', Carbon::now()->subDays(7))->count();

        // Query Utama dengan Pencarian Internal Halaman Kategori & Hitung Relasi Buku
        $query = Category::withCount('books');

        if ($request->has('search_category') && $request->search_category != '') {
            $query->where('name', 'like', '%' . $request->search_category . '%');
        }

        $categories = $query->paginate(10)->withQueryString();

        return view('admin.kategori', compact(
            'categories', 
            'totalKategori', 
            'kategoriAktif', 
            'baruDitambahkan'
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
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'required|boolean',
        ]);

        Category::create($request->all());

        return redirect()->back()->with('success', 'Kategori baru berhasil ditambahkan.');
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
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string|max:1000',
            'is_active' => 'required|boolean',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        // Proteksi jika kategori masih digunakan oleh buku
        if ($category->books()->count() > 0) {
            return redirect()->back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki relasi ke data buku.');
        }

        $category->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }
}
