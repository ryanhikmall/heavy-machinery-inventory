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
| 1. RUTE PUBLIC
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| 2. RUTE TERAUTENTIKASI
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // =================================================================
    // PENTING: RUTE KHUSUS (ADMIN/CREATE/EDIT) HARUS DI ATAS RUTE 'SHOW'
    // =================================================================
    
    // 1. Rute Admin (Create, Store, Edit, Update, Destroy)
    // Ditaruh di atas agar "spareparts/create" dicek duluan sebelum "spareparts/{id}"
    Route::middleware(['is_admin'])->group(function () {
        Route::resource('categories', CategoryController::class)->except(['index']);
        Route::resource('units', UnitController::class)->except(['index']);
        
        // Admin punya akses penuh (kecuali index & show yang sudah dihandle di bawah)
        // Tapi create & edit akan didefinisikan di sini
        Route::resource('spareparts', SparepartController::class)->except(['index', 'show']);
    });

    // 2. Rute User Biasa / Umum (Index & Show)
    // Ditaruh di bawah. Jika URL bukan 'create' atau 'edit', baru masuk sini (dianggap ID)
    Route::resource('categories', CategoryController::class)->only(['index']);
    Route::resource('units', UnitController::class)->only(['index']);
    
    Route::resource('spareparts', SparepartController::class)->only(['index', 'show']);
    
    Route::resource('transactions', TransactionController::class);

});