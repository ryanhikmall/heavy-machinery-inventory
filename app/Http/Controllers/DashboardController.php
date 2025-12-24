<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung total jenis barang
        $total_items = Sparepart::count();

        // 2. Hitung barang yang stoknya menipis (Stok <= Min Stock)
        $low_stock = Sparepart::whereColumn('stock', '<=', 'min_stock')->count();

        // 3. Hitung total kategori
        $total_categories = Category::count();

        // 4. Ambil 5 barang yang BARU SAJA ditambahkan/diupdate
        // Menggunakan 'with' agar query lebih efisien (Eager Loading)
        $recent_items = Sparepart::with('category')
                                 ->latest() // Urutkan dari yang paling baru dibuat
                                 ->take(5)  // Batasi hanya 5 data
                                 ->get();

        // Kirim semua variabel ke view dashboard
        return view('dashboard', compact(
            'total_items', 
            'low_stock', 
            'total_categories', 
            'recent_items'
        ));
    }
}