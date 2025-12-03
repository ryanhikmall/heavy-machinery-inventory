<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Sparepart;
use App\Models\Unit; // Tambahkan ini agar tidak error saat memanggil Unit
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // 1. Menampilkan Halaman List Transaksi
    public function index()
    {
        // Ambil data transaksi terbaru dengan relasi sparepart
        $transactions = Transaction::with(['sparepart', 'unit'])->latest()->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    // 2. Menampilkan Form Input Transaksi
    public function create()
    {
        return view('transactions.create');
    }

    // 3. Menyimpan Data (Logika Stok)
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'sparepart_id' => 'required',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
            // Unit wajib diisi HANYA JIKA tipe transaksinya 'out'
            'unit_id' => 'nullable|required_if:type,out', 
        ]);

        // Ambil Data Barang
        $sparepart = Sparepart::findOrFail($request->sparepart_id);

        // Cek Stok (Khusus Barang Keluar)
        if ($request->type == 'out' && $sparepart->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak cukup! Sisa stok: ' . $sparepart->stock);
        }

        // Simpan Transaksi
        Transaction::create($request->all());

        // Update Stok Master Barang
        if ($request->type == 'in') {
            $sparepart->increment('stock', $request->quantity);
        } else {
            $sparepart->decrement('stock', $request->quantity);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil & Stok terupdate!');
    }
}