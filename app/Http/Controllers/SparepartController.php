<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use App\Models\Category; // <--- INI YANG TADI HILANG / KURANG
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    /**
     * Menampilkan daftar sparepart
     */
    public function index()
    {
        // Ambil data, urutkan terbaru, pagination 10 baris
        $spareparts = Sparepart::with('category')->latest()->paginate(10);
        return view('spareparts.index', compact('spareparts'));
    }

    /**
     * Menampilkan form tambah barang baru
     */
    public function create()
    {
        // Kita butuh data Kategori untuk dropdown
        $categories = Category::all(); 
        return view('spareparts.create', compact('categories'));
    }

    /**
     * Menyimpan data barang baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'category_id' => 'required',
            'part_number' => 'required|unique:spareparts,part_number',
            'name' => 'required',
            'min_stock' => 'required|integer',
        ]);

        // Simpan ke database
        Sparepart::create($request->all());

        return redirect()->route('spareparts.index')->with('success', 'Sparepart berhasil ditambahkan!');
    }

    /**
     * (Opsional) Menampilkan form edit - Belum kita buat view-nya
     */
    public function edit(Sparepart $sparepart)
    {
        // Nanti diimplementasikan
    }

    /**
     * (Opsional) Update data
     */
    public function update(Request $request, Sparepart $sparepart)
    {
        // Nanti diimplementasikan
    }

    /**
     * Menghapus barang
     */
    public function destroy(Sparepart $sparepart)
    {
        // Nanti diimplementasikan
    }
}