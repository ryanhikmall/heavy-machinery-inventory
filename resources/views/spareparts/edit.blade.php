@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <!-- Header Page -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold font-display text-slate-800 tracking-tight">Edit Sparepart</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Perbarui informasi barang yang sudah terdaftar.</p>
        </div>
        <a href="{{ route('spareparts.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors px-4 py-2 rounded-xl hover:bg-white/50">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Glass Form Container -->
    <div class="bg-white/60 backdrop-blur-xl rounded-[2rem] border border-white/50 shadow-[0_20px_50px_rgb(0,0,0,0.05)] p-8 md:p-10 relative overflow-hidden">
        
        <!-- Decorative Gradient Blob -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-amber-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

        <!-- Form Edit: Perhatikan action route dan method PUT -->
        <form action="{{ route('spareparts.update', $sparepart->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- SECTION 1: Informasi Dasar -->
            <div class="mb-8">
                <h3 class="text-sm font-bold text-indigo-500 uppercase tracking-wider mb-6 flex items-center gap-2">
                    <i class="fas fa-edit"></i> Perbarui Informasi
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kategori -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="category_id" required
                                class="block w-full rounded-xl border-0 bg-white/50 ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500/50 text-slate-700 py-3.5 px-4 transition-all duration-300 outline-none shadow-sm hover:bg-white appearance-none cursor-pointer">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $sparepart->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Part Number -->
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">
                            Part Number (Kode) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="part_number" value="{{ old('part_number', $sparepart->part_number) }}" required
                               class="block w-full rounded-xl border-0 bg-white/50 ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500/50 text-slate-700 py-3.5 px-4 transition-all duration-300 outline-none shadow-sm placeholder:text-slate-300 hover:bg-white">
                    </div>

                    <!-- Nama Barang -->
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">
                            Nama Barang <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name', $sparepart->name) }}" required
                               class="block w-full rounded-xl border-0 bg-white/50 ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500/50 text-slate-700 py-3.5 px-4 transition-all duration-300 outline-none shadow-sm placeholder:text-slate-300 hover:bg-white">
                    </div>
                </div>
            </div>

            <hr class="border-slate-200/60 my-8">

            <!-- SECTION 2: Inventaris & Lokasi -->
            <div class="mb-6">
                <h3 class="text-sm font-bold text-indigo-500 uppercase tracking-wider mb-6 flex items-center gap-2">
                    <i class="fas fa-boxes"></i> Stok & Lokasi
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Stok Saat Ini (Bisa diedit manual jika perlu koreksi, atau readonly jika ingin ketat) -->
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">
                            Stok Saat Ini
                        </label>
                        <input type="number" name="stock" value="{{ old('stock', $sparepart->stock) }}" min="0"
                               class="block w-full rounded-xl border-0 bg-white/50 ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500/50 text-slate-700 py-3.5 px-4 transition-all duration-300 outline-none shadow-sm hover:bg-white">
                    </div>

                    <!-- Min Stock -->
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">
                            Min. Stock Alert <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="min_stock" value="{{ old('min_stock', $sparepart->min_stock) }}" required
                               class="block w-full rounded-xl border-0 bg-white/50 ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500/50 text-slate-700 py-3.5 px-4 transition-all duration-300 outline-none shadow-sm hover:bg-white">
                    </div>

                    <!-- Satuan -->
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">
                            Satuan
                        </label>
                        <input type="text" name="unit" value="{{ old('unit', $sparepart->unit) }}" placeholder="Pcs/Set/Box"
                               class="block w-full rounded-xl border-0 bg-white/50 ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500/50 text-slate-700 py-3.5 px-4 transition-all duration-300 outline-none shadow-sm hover:bg-white">
                    </div>
                </div>

                <!-- Lokasi Rak -->
                <div class="mt-6">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">
                        Lokasi Rak (Opsional)
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <input type="text" name="location" value="{{ old('location', $sparepart->location) }}" placeholder="Contoh: Rak A-1, Bin 3"
                               class="block w-full rounded-xl border-0 bg-white/50 ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500/50 text-slate-700 py-3.5 pl-10 px-4 transition-all duration-300 outline-none shadow-sm hover:bg-white">
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-4 mt-10">
                <a href="{{ route('spareparts.index') }}" 
                   class="px-6 py-3.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-all duration-300">
                    Batal
                </a>
                <button type="submit" 
                        class="px-8 py-3.5 rounded-xl text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 shadow-lg shadow-slate-900/20 transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]">
                    <i class="fas fa-check-circle mr-2"></i> Perbarui Data
                </button>
            </div>

        </form>
    </div>
</div>
@endsection