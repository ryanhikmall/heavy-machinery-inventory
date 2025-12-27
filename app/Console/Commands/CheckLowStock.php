<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sparepart;
use App\Models\User;
use App\Notifications\LowStockAlert;

class CheckLowStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:check'; // Mengubah signature agar sesuai dengan scheduler di console.php

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek stok barang menipis dan kirim notifikasi ke Admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai pengecekan stok...');

        // 1. Ambil barang yang stock <= min_stock
        $lowStockItems = Sparepart::whereColumn('stock', '<=', 'min_stock')->get();

        if ($lowStockItems->isEmpty()) {
            $this->info('Stok aman. Tidak ada notifikasi yang dikirim.');
            return;
        }

        // 2. Ambil semua User dengan role 'admin'
        // Pastikan nama kolom 'role' dan nilai 'admin' sesuai dengan database Anda
        $admins = User::where('role', 'admin')->get();

        if ($admins->isEmpty()) {
            $this->error('Tidak ada user Admin ditemukan untuk dikirimi notifikasi.');
            return;
        }

        // 3. Kirim Notifikasi ke setiap Admin
        $this->info('Mengirim notifikasi ke ' . $admins->count() . ' admin...');
        
        foreach ($admins as $admin) {
            // Menggunakan notifikasi yang sudah kita buat sebelumnya
            $admin->notify(new LowStockAlert($lowStockItems));
            $this->line("- Notifikasi terkirim ke: {$admin->email}");
        }

        $this->info('Selesai! Ditemukan ' . $lowStockItems->count() . ' barang yang perlu restock.');
    }
}