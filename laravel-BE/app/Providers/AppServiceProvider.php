<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        View::composer('layouts.layout-admin', function ($view) {
            $today = Carbon::today();

            // Cari peminjaman yang terlambat
            $overdueLoans = Loan::with(['user', 'book'])
                ->where('status', 'dipinjam')
                ->where('due_at', '<', $today)
                ->get()
                ->map(function ($loan) {
                    return [
                        'type' => 'overdue',
                        'icon' => 'fa-calendar-times',
                        'color' => 'red',
                        'message' => "Peminjaman {$loan->user->name} ({$loan->book->title}) terlambat!"
                    ];
                });

            // Cari stok buku yang habis
            $emptyBooks = Book::where('available_copies', 0)
                ->get()
                ->map(function ($book) {
                    return [
                        'type' => 'empty_stock',
                        'icon' => 'fa-exclamation-triangle',
                        'color' => 'orange',
                        'message' => "Stok buku '{$book->title}' sudah habis (0)."
                    ];
                });

            // Gabungkan semua notifikasi ke dalam satu koleksi
            $allNotifications = $overdueLoans->concat($emptyBooks);
            
            $view->with([
                'adminNotifications' => $allNotifications,
                'notificationCount' => $allNotifications->count()
            ]);
        });
        View::composer('layouts.layout-user', function ($view) {
        $today = Carbon::today();
        $memberNotifications = collect();

        if (Auth::check()) {
            $userId = Auth::id();

            $overdueLoans = Loan::with(['book'])
                ->where('user_id', $userId)
                ->where('status', 'dipinjam')
                ->where('due_at', '<', $today)
                ->get()
                ->map(function ($loan) {
                    return [
                        'type' => 'overdue',
                        'icon' => 'fa-calendar-times',
                        'color' => '#e74c3c', 
                        'message' => "Buku '{$loan->book->title}' Anda terlambat dikembalikan! Batas waktu: " . Carbon::parse($loan->due_at)->format('d M Y')
                    ];
                });

            // Cari buku denda milik MEMBER INI yang belum lunas (Opsional, sangat berguna bagi member)
            // Anda bisa mengaktifkan bagian ini jika memiliki model Fine/Denda
            /*
            $unpaidFines = \App\Models\Fine::where('user_id', $userId)
                ->where('status', 'belum_lunas')
                ->get()
                ->map(function ($fine) {
                    return [
                        'type' => 'fine',
                        'icon' => 'fa-file-invoice-dollar',
                        'color' => '#f39c12', // Orange
                        'message' => "Anda memiliki tunggakan denda sebesar Rp " . number_format($fine->amount, 0, ',', '.')
                    ];
                });
            */

            // Gabungkan semua notifikasi personal member
            $memberNotifications = $overdueLoans;
            
            // Jika mengaktifkan denda, gabungkan:
            // $memberNotifications = $overdueLoans->concat($unpaidFines);
        }

        // Kirimkan variabel ke layout Blade dengan nama yang serasi
        $view->with([
            'adminNotifications' => $memberNotifications, // Tetap menggunakan nama ini agar tidak perlu merubah tag @forelse di layout Anda
            'notificationCount' => $memberNotifications->count()
        ]);
    });
    }
}
