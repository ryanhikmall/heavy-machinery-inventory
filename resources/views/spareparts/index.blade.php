@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    
    <!-- Header & Action -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold font-display text-slate-800 tracking-tight">Stok Sparepart</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Kelola data suku cadang dan stok gudang Anda.</p>
        </div>
        
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('spareparts.create') }}" 
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 shadow-lg shadow-slate-900/20 transition-all duration-300 hover:scale-[1.02]">
                <i class="fas fa-plus"></i> Tambah Barang
            </a>
        @endif
    </div>

    <!-- Glass Table Container -->
    <div class="bg-white/60 backdrop-blur-xl rounded-[2rem] border border-white/50 shadow-[0_20px_50px_rgb(0,0,0,0.05)] overflow-hidden relative">
        
        <!-- Decorative Top Line -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-indigo-500/50 to-transparent opacity-50"></div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/50 text-xs uppercase text-slate-400 font-bold tracking-wider border-b border-slate-100/50">
                    <tr>
                        <th class="px-8 py-5">Part Number</th>
                        <th class="px-8 py-5">Nama Barang</th>
                        <th class="px-8 py-5">Kategori</th>
                        <th class="px-8 py-5">Stok</th>
                        <th class="px-8 py-5">Lokasi</th>
                        @if(Auth::user()->role === 'admin')
                        <th class="px-8 py-5 text-right">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/50">
                    @forelse($spareparts as $item)
                    <!-- Row Logic: Jika stok <= min_stock, beri background merah tipis -->
                    <tr class="transition-colors group {{ $item->stock <= $item->min_stock ? 'bg-red-50/60 hover:bg-red-50/80' : 'hover:bg-white/50' }}">
                        
                        <!-- Part Number -->
                        <td class="px-8 py-5 font-mono text-slate-500 font-medium">
                            {{ $item->part_number }}
                        </td>
                        
                        <!-- Nama Barang -->
                        <td class="px-8 py-5">
                            <span class="font-bold text-slate-700 font-display text-base block">{{ $item->name }}</span>
                            @if($item->stock <= $item->min_stock)
                                <div class="inline-flex items-center gap-1 mt-1 text-[10px] font-bold uppercase tracking-wider text-red-500 animate-pulse">
                                    <i class="fas fa-exclamation-circle"></i> Stok Menipis
                                </div>
                            @endif
                        </td>
                        
                        <!-- Kategori (Badge Style) -->
                        <td class="px-8 py-5">
                            <span class="inline-block px-3 py-1 bg-white/60 border border-slate-200 rounded-lg text-xs font-bold text-slate-600 shadow-sm">
                                {{ $item->category->name ?? '-' }}
                            </span>
                        </td>
                        
                        <!-- Stok -->
                        <td class="px-8 py-5">
                            <div class="flex items-baseline gap-1">
                                <span class="text-lg font-bold {{ $item->stock <= $item->min_stock ? 'text-red-600' : 'text-slate-700' }}">
                                    {{ $item->stock }}
                                </span>
                                <span class="text-xs text-slate-400 font-medium">{{ $item->unit ?? 'Pcs' }}</span>
                            </div>
                        </td>
                        
                        <!-- Lokasi -->
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-2 text-slate-500">
                                <i class="fas fa-map-marker-alt text-slate-300"></i>
                                {{ $item->location ?? '-' }}
                            </div>
                        </td>

                        <!-- Aksi -->
                        @if(Auth::user()->role === 'admin')
                        <td class="px-8 py-5 text-right">
                            <div class="inline-flex items-center justify-end gap-2 opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity duration-200">
                                <!-- Edit Button -->
                                <a href="#" class="w-9 h-9 rounded-xl flex items-center justify-center text-amber-500 hover:bg-amber-50 hover:text-amber-600 transition-colors shadow-sm ring-1 ring-slate-100 bg-white" title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <!-- Delete Button (Placeholder Form) -->
                                {{-- 
                                <form action="{{ route('spareparts.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus barang ini?');">
                                    @csrf @method('DELETE') 
                                --}}
                                <button type="button" class="w-9 h-9 rounded-xl flex items-center justify-center text-red-400 hover:bg-red-50 hover:text-red-600 transition-colors shadow-sm ring-1 ring-slate-100 bg-white" title="Hapus Data">
                                    <i class="fas fa-trash"></i>
                                </button>
                                {{-- </form> --}}
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-10 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3 text-slate-300">
                                    <i class="fas fa-box-open text-2xl"></i>
                                </div>
                                <p class="font-medium">Belum ada data sparepart.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-8 py-6 border-t border-slate-100/50 bg-slate-50/30">
            {{ $spareparts->links() }}
        </div>
    </div>
</div>
@endsection