@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">

    <!-- Header & Action -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold font-display text-slate-800 tracking-tight">Master Kategori</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Kelola pengelompokan jenis barang inventaris.</p>
        </div>
        <a href="{{ route('categories.create') }}" 
           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 shadow-lg shadow-slate-900/20 transition-all duration-300 hover:scale-[1.02]">
            <i class="fas fa-plus"></i> Tambah Kategori
        </a>
    </div>

    <!-- Glass Table Container -->
    <div class="bg-white/60 backdrop-blur-xl rounded-[2rem] border border-white/50 shadow-[0_20px_50px_rgb(0,0,0,0.05)] overflow-hidden relative">
        
        <!-- Decorative Top Line -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-indigo-500/50 to-transparent opacity-50"></div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/50 text-xs uppercase text-slate-400 font-bold tracking-wider border-b border-slate-100/50">
                    <tr>
                        <th class="px-8 py-5 w-20">No</th>
                        <th class="px-8 py-5">Nama Kategori</th>
                        <th class="px-8 py-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/50">
                    @forelse($categories as $index => $cat)
                    <tr class="hover:bg-white/50 transition-colors group">
                        
                        <!-- Nomor -->
                        <td class="px-8 py-5 font-mono text-slate-500 font-medium">
                            {{ $index + 1 }}
                        </td>
                        
                        <!-- Nama Kategori -->
                        <td class="px-8 py-5">
                            <span class="font-bold text-slate-700 font-display text-base block group-hover:text-indigo-600 transition-colors">
                                {{ $cat->name }}
                            </span>
                        </td>
                        
                        <!-- Aksi -->
                        <td class="px-8 py-5 text-right">
                            <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori ini?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-9 h-9 rounded-xl flex items-center justify-center text-red-400 hover:bg-red-50 hover:text-red-600 transition-colors shadow-sm ring-1 ring-slate-100 bg-white" 
                                        title="Hapus Kategori">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-8 py-10 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3 text-slate-300">
                                    <i class="fas fa-tags text-2xl"></i>
                                </div>
                                <p class="font-medium">Belum ada data kategori.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection