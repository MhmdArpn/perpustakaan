<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookSearchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\Member\CategoryUserController;
use App\Http\Controllers\Member\DashboardUserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReturnController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showUserLogin'])->name('login');
    Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'role:member'])->group(function () {
    Route::prefix('member')->group(function () {
        Route::get('/', [DashboardUserController::class, 'index'])->name('user.dashboard');
        Route::get('/cari-buku', [BookSearchController::class, 'index'])->name('user.cari-buku');
        Route::get('/kategori', [CategoryUserController::class, 'index'])->name('user.kategori');
        Route::get('/peminjaman', [LoanController::class, 'index'])->name('user.peminjaman');
        Route::get('/riwayat', [ReturnController::class, 'index'])->name('user.riwayat');
        Route::get('/wishlist', [BookController::class, 'wishlist'])->name('user.wishlist');
        Route::get('/profile', [MemberController::class, 'profile'])->name('user.profile');
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

        Route::resource('kategori', CategoryController::class)->names([
            'index'     => 'admin.categories',
            'store'     => 'admin.categories.store',
            'update'    => 'admin.categories.update',
            'destroy'   => 'admin.categories.destroy',
        ]);

        Route::resource('peminjaman', LoanController::class)->names([
            'index'   => 'admin.loans',
            'store'   => 'admin.loans.store',
            'update'  => 'admin.loans.update',
            'destroy' => 'admin.loans.destroy',
        ]);

        Route::resource('pengembalian', ReturnController::class)->names([
            'index'   => 'admin.returns',
            'store'   => 'admin.returns.store',
            'update'  => 'admin.returns.update',
            'destroy' => 'admin.returns.destroy',
        ]);

        Route::resource('member', MemberController::class)->names([
            'index'   => 'admin.members',
            'store'   => 'admin.members.store',
            'update'  => 'admin.members.update',
            'destroy' => 'admin.members.destroy',
        ]);

        Route::resource('denda', FineController::class)->names([
            'index'   => 'admin.fines',
            'store'   => 'admin.fines.store',
            'update'  => 'admin.fines.update',
            'destroy' => 'admin.fines.destroy',
        ]);

        Route::get('/laporan', [ReportController::class, 'index'])->name('admin.reports');
        Route::get('/laporan/export/{id}', [ReportController::class, 'exportPdf'])->name('admin.reports.export');
    });
});