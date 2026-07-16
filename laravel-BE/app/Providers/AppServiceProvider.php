<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Loan;
use Carbon\Carbon;
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
    }
}
