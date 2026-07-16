<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/member');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showUserLogin'])->name('login');
    Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'role:member'])->group(function () {
    Route::prefix('member')->group(function () {
        
    });
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/', 'dashboard')->name('admin.dashboard');
        });
        Route::resource('data-buku', BookController::class)->names([
            'index'     => 'admin.books',
            'store'     => 'admin.books.store',
            'update'    => 'admin.books.update',
            'destroy'   => 'admin.books.destroy',
        ]);

        Route::get('/kategori', function () {
            return view('admin.kategori');
        })->name('admin.categories');

        Route::get('/peminjaman', function () {
            return view('admin.peminjaman');
        })->name('admin.loans');

        Route::get('/pengembalian', function () {
            return view('admin.pengembalian');
        })->name('admin.returns');

        Route::get('/denda', function () {
            return view('admin.denda');
        })->name('admin.fines');

        Route::get('/member', function () {
            return view('admin.member');
        })->name('admin.members');

        Route::get('/laporan', function () {
            return view('admin.laporan');
        })->name('admin.reports');
    });
});