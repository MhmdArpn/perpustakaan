<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Hanya ambil data yang rolenya adalah 'member'
        $query = User::where('role', 'member');

        // Fitur Pencarian (Berdasarkan Nama, Email, atau Telepon)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Ambil data dengan pagination
        $members = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // Hitung data statistik kartu (Cards)
        $totalMember = User::where('role', 'member')->count();
        $aktif = User::where('role', 'member')->where('status', 'active')->count();
        $baruBulanIni = User::where('role', 'member')
                            ->whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', Carbon::now()->year)
                            ->count();
        $premium = User::where('role', 'member')->where('membership_type', 'premium')->count();

        return view('admin.member', compact('members', 'totalMember', 'aktif', 'baruBulanIni', 'premium'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:15',
            'status' => 'required|in:active,pending,inactive',
            'membership_type' => 'required|in:regular,premium',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'membership_type' => $request->membership_type,
            'role' => 'member',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.members')->with('success', 'Member baru berhasil ditambahkan.');
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
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'status' => 'required|in:active,pending,inactive',
            'membership_type' => 'required|in:regular,premium',
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'membership_type' => $request->membership_type,
        ];

        // Ganti password jika diisi oleh admin
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.members')->with('success', 'Data member berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.members')->with('success', 'Data member berhasil dihapus.');
    }
}
