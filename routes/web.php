    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\SparepartController;
    use App\Http\Controllers\TransactionController;
    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\UnitController;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\NotificationController; // <--- JANGAN LUPA IMPORT INI

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
        
        // --- RUTE NOTIFIKASI (BARU) ---
        // Pastikan Controller NotificationController sudah dibuat
        Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
        Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');


        // 1. Rute Admin (Create, Store, Edit, Update, Destroy)
        Route::middleware(['is_admin'])->group(function () {
            Route::resource('categories', CategoryController::class)->except(['index']);
            Route::resource('units', UnitController::class)->except(['index']);
            
            // Admin punya akses penuh
            Route::resource('spareparts', SparepartController::class)->except(['index', 'show']);
        });

        // 2. Rute User Biasa / Umum (Index & Show)
        Route::resource('categories', CategoryController::class)->only(['index']);
        Route::resource('units', UnitController::class)->only(['index']);
        
        Route::resource('spareparts', SparepartController::class)->only(['index', 'show']);
        
        Route::resource('transactions', TransactionController::class);

    });