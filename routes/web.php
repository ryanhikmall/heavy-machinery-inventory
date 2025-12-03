<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\TransactionController;
// Jangan lupa import controller untuk Category dan Unit:
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Rute Dashboard (Halaman Utama)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// 2. Rute Master Data (Kategori & Unit) - INI YANG TADI HILANG
Route::resource('categories', CategoryController::class);
Route::resource('units', UnitController::class);

// 3. Rute Sparepart & Transaksi
Route::resource('spareparts', SparepartController::class);
Route::resource('transactions', TransactionController::class);

use App\Http\Controllers\AuthController;

// --- RUTE PUBLIC (LOGIN & LOGOUT) ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Tampilkan Form
Route::post('/login', [AuthController::class, 'login'])->name('login.post');   // Proses Submit
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');     // Proses Logout