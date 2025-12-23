@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    
    <!-- Header Page -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold font-display text-slate-800 tracking-tight">Tambah Kategori</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Buat kategori baru untuk pengelompokan barang.</p>
        </div>
        <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors px-4 py-2 rounded-xl hover:bg-white/50">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Glass Form Container -->
    <div class="bg-white/60 backdrop-blur-xl rounded-[2rem] border border-white/50 shadow-[0_20px_50px_rgb(0,0,0,0.05)] p-8 md:p-10 relative overflow-hidden">
        
        <!-- Decorative Gradient Blob -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-indigo-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <!-- Input Group -->
            <div class="mb-8 relative z-10">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fas fa-tag"></i>
                    </div>
                    <input type="text" name="name" placeholder="Contoh: Filter, Hose, Tyre, Heavy Parts" required autofocus
                           class="block w-full rounded-xl border-0 bg-white/50 ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500/50 text-slate-700 py-4 pl-10 px-4 transition-all duration-300 outline-none shadow-sm placeholder:text-slate-300 hover:bg-white text-lg">
                </div>
                <p class="text-[10px] text-slate-400 mt-2 ml-1">
                    <i class="fas fa-info-circle mr-1"></i> Nama kategori harus unik dan belum pernah terdaftar.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-slate-100/50">
                <a href="{{ route('categories.index') }}" 
                   class="px-6 py-3.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-all duration-300">
                    Batal
                </a>
                <button type="submit" 
                        class="px-8 py-3.5 rounded-xl text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 shadow-lg shadow-slate-900/20 transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]">
                    <i class="fas fa-save mr-2"></i> Simpan Kategori
                </button>
            </div>

        </form>
    </div>
</div>
@endsection