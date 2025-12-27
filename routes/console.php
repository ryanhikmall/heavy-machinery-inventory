<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// --- JADWAL CEK STOK (TAMBAHKAN INI) ---
// Menjalankan perintah 'stock:check' setiap hari jam 08:00 pagi
Schedule::command('stock:check')->dailyAt('08:00');