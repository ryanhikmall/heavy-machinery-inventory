<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIC (LOGIN & LOGOUT)
|--------------------------------------------------------------------------
*/

// Middleware 'guest' artinya: Kalau sudah login, jangan boleh masuk sini (tendang ke dashboard)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Logout harus bisa diakses oleh orang yang sedang login (auth)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| 2. RUTE USER / STAFF (Bisa Diakses Semua User Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // --> INI LOGIKA DIRECT LOGIN <--
    // Karena ada di dalam middleware 'auth', user yang belum login otomatis dilempar ke login
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class)->only(['index']);
    Route::resource('units', UnitController::class)->only(['index']);

    // Semua user boleh lihat daftar sparepart & input transaksi
    Route::resource('spareparts', SparepartController::class)->only(['index', 'show']);
    Route::resource('transactions', TransactionController::class);
});

/*
|--------------------------------------------------------------------------
| 3. RUTE KHUSUS ADMIN (Full Akses Master Data)
|--------------------------------------------------------------------------
*/
// Gabungan 'auth' DAN 'is_admin'
Route::middleware(['auth', 'is_admin'])->group(function () {
    
    // Admin bisa CRUD Master Data (Kategori & Unit)
  Route::resource('categories', CategoryController::class)->except(['index']);
    Route::resource('units', UnitController::class)->except(['index']);

    // Admin bisa Create/Edit/Delete Sparepart (User biasa cuma index/lihat)
    Route::resource('spareparts', SparepartController::class)->except(['index', 'show']);
});