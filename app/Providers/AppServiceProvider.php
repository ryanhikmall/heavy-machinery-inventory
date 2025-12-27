<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Sparepart;             // <--- Tambahan
use App\Observers\SparepartObserver;  // <--- Tambahan

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
        // Gunakan Bootstrap styling untuk pagination (agar rapi)
        Paginator::useBootstrapFive();

        // AKTIFKAN OBSERVER DI SINI
        // "Hei Sparepart, kamu sekarang diawasi oleh SparepartObserver ya!"
        Sparepart::observe(SparepartObserver::class);
    }
}