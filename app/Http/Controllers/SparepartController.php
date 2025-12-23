<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use App\Models\Category;
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
            // Tambahkan validasi lain jika perlu
        ]);

        // Simpan ke database
        Sparepart::create($request->all());

        return redirect()->route('spareparts.index')->with('success', 'Sparepart berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail barang (INI YANG MENYEBABKAN ERROR SEBELUMNYA)
     */
    public function show($id)
    {
        // Cari sparepart berdasarkan ID
        $sparepart = Sparepart::findOrFail($id);
        
        // SEMENTARA: Karena belum ada view 'show', kita redirect ke index dulu
        // Nanti jika sudah buat view 'spareparts.show', ubah baris ini.
        // return view('spareparts.show', compact('sparepart'));
        
        return redirect()->route('spareparts.index');
    }

    /**
     * Menampilkan form edit
     */
    public function edit(Sparepart $sparepart)
    {
        $categories = Category::all();
        return view('spareparts.edit', compact('sparepart', 'categories'));
    }

    /**
     * Update data
     */
    public function update(Request $request, Sparepart $sparepart)
    {
        $request->validate([
            'category_id' => 'required',
            'part_number' => 'required|unique:spareparts,part_number,' . $sparepart->id,
            'name' => 'required',
            'min_stock' => 'required|integer',
        ]);

        $sparepart->update($request->all());

        return redirect()->route('spareparts.index')->with('success', 'Sparepart berhasil diperbarui!');
    }

    /**
     * Menghapus barang
     */
    public function destroy(Sparepart $sparepart)
    {
        $sparepart->delete();
        return redirect()->route('spareparts.index')->with('success', 'Sparepart berhasil dihapus!');
    }
}