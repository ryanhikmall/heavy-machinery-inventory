<?php

namespace App\Observers;

use App\Models\Sparepart;
use App\Models\User;
use App\Notifications\LowStockAlert;
use Illuminate\Support\Facades\Notification;

class SparepartObserver
{
    /**
     * Handle the Sparepart "updated" event.
     * Fungsi ini jalan OTOMATIS setiap kali ada data sparepart yang di-update.
     */
    public function updated(Sparepart $sparepart)
    {
        // Cek 1: Apakah stok sekarang di bawah atau sama dengan batas minimum?
        // Cek 2: Pastikan stok memang berubah (bukan cuma ganti nama barang)
        if ($sparepart->stock <= $sparepart->min_stock && $sparepart->isDirty('stock')) {
            
            // Ambil admin
            $admins = User::where('role', 'admin')->get();
            
            if ($admins->count() > 0) {
                // Bungkus sparepart dalam collection karena notifikasi kita mengharapkan array/collection
                $items = collect([$sparepart]);
                
                // Kirim notifikasi detik itu juga!
                Notification::send($admins, new LowStockAlert($items));
            }
        }
    }
}