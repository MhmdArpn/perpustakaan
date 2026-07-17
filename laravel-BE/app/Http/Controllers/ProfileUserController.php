<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mengambil statistik riil perpustakaan milik user
        $totalReadCount = Loan::where('user_id', $user->id)->where('status', 'returned')->count();
        $activeLoanCount = Loan::where('user_id', $user->id)->where('status', 'borrowed')->count();
        $wishlistCount = Wishlist::where('user_id', $user->id)->count();
        
        // Asumsi jika kolom 'due_date' melewati tanggal sekarang dan belum dikembalikan
        $overdueCount = Loan::where('user_id', $user->id)
            ->where('status', 'dipinjam')
            ->where('due_at', '<', now())
            ->count();

        return view('member.profile', compact('totalReadCount', 'activeLoanCount', 'wishlistCount', 'overdueCount'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('name', 'email', 'phone', 'address');

        // Menangani unggahan file Avatar baru
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Informasi profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Validasi password saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak cocok.']);
        }

        // Perbarui password baru
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('success', 'Kata sandi akun Anda berhasil diganti!');
    }
}
