@extends('layouts.app')

@section('title', 'Dashboard Overview')

@section('content')
    <!-- Greeting -->
    <div class="mb-10">
        <h2 class="text-3xl font-bold font-display text-slate-800 mb-2 tracking-tight">
            Halo, {{ Auth::user()->name ?? 'User' }}! 👋
        </h2>
        <p class="text-slate-500 font-medium">
            Selamat datang kembali, {{ ucfirst(Auth::user()->role ?? 'Staff') }}. Berikut adalah ringkasan inventaris hari ini.
        </p>
    </div>

    <!-- STATS GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        
        <!-- Card 1: Total Barang -->
        <div class="bg-white/60 backdrop-blur-xl rounded-[2rem] p-8 shadow-[0_10px_30px_rgb(0,0,0,0.04)] border border-white/50 relative overflow-hidden group hover:-translate-y-1 transition-all duration-300">
            <div class="flex justify-between items-start z-10 relative">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Total Jenis Barang</p>
                    <h3 class="text-4xl font-bold font-display text-slate-800">{{ $total_items ?? '0' }}</h3>
                </div>
                <div class="w-12 h-12 bg-white/80 rounded-2xl flex items-center justify-center text-indigo-600 shadow-sm ring-1 ring-slate-100">
                    <i class="fas fa-boxes text-lg"></i>
                </div>
            </div>
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-gradient-to-br from-indigo-100 to-transparent rounded-full opacity-50 blur-2xl group-hover:scale-110 transition-transform duration-500"></div>
        </div>

        <!-- Card 2: Perlu Restock -->
        <div class="bg-white/60 backdrop-blur-xl rounded-[2rem] p-8 shadow-[0_10px_30px_rgb(0,0,0,0.04)] border border-white/50 relative overflow-hidden group hover:-translate-y-1 transition-all duration-300">
            <div class="flex justify-between items-start z-10 relative">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Perlu Restock</p>
                    <h3 class="text-4xl font-bold font-display text-slate-800">{{ $low_stock ?? '0' }}</h3>
                    
                    @if(($low_stock ?? 0) > 0)
                        <div class="mt-2 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-red-50 text-red-600 border border-red-100 animate-pulse">
                            <i class="fas fa-exclamation-circle text-[10px]"></i>
                            <span class="text-[10px] font-bold uppercase tracking-wide">Stok Kritis</span>
                        </div>
                    @else
                        <div class="mt-2 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100">
                            <i class="fas fa-check-circle text-[10px]"></i>
                            <span class="text-[10px] font-bold uppercase tracking-wide">Aman</span>
                        </div>
                    @endif
                </div>
                <div class="w-12 h-12 bg-white/80 rounded-2xl flex items-center justify-center text-red-500 shadow-sm ring-1 ring-slate-100">
                    <i class="fas fa-arrow-trend-down text-lg"></i>
                </div>
            </div>
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-gradient-to-br from-red-100 to-transparent rounded-full opacity-50 blur-2xl group-hover:scale-110 transition-transform duration-500"></div>
        </div>

        <!-- Card 3: Nilai Aset (Contoh Statis / Hitungan) -->
        <div class="bg-white/60 backdrop-blur-xl rounded-[2rem] p-8 shadow-[0_10px_30px_rgb(0,0,0,0.04)] border border-white/50 relative overflow-hidden group hover:-translate-y-1 transition-all duration-300 hidden md:block">
            <div class="flex justify-between items-start z-10 relative">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Total Kategori</p>
                    <h3 class="text-4xl font-bold font-display text-slate-800">{{ $total_categories ?? '0' }}</h3>
                    <div class="mt-2 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100">
                         <i class="fas fa-tags text-[10px]"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wide">Kategori Aktif</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-white/80 rounded-2xl flex items-center justify-center text-emerald-600 shadow-sm ring-1 ring-slate-100">
                    <i class="fas fa-chart-pie text-lg"></i>
                </div>
            </div>
             <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-gradient-to-br from-emerald-100 to-transparent rounded-full opacity-50 blur-2xl group-hover:scale-110 transition-transform duration-500"></div>
        </div>

    </div>

    <!-- RECENT ITEMS TABLE (Glass Style) -->
    <div class="bg-white/60 backdrop-blur-xl rounded-[2rem] border border-white/50 shadow-[0_20px_50px_rgb(0,0,0,0.05)] overflow-hidden relative">
        
        <!-- Decorative Top Line -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-indigo-500/50 to-transparent opacity-50"></div>

        <div class="px-8 py-6 border-b border-slate-100/50 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 font-display tracking-tight text-lg">Barang Baru Ditambahkan</h3>
            <a href="{{ route('spareparts.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-bold tracking-wide flex items-center gap-1 group">
                Lihat Semua <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/50 text-xs uppercase text-slate-400 font-bold tracking-wider">
                    <tr>
                        <th class="px-8 py-5">Nama Barang</th>
                        <th class="px-8 py-5">Kategori</th>
                        <th class="px-8 py-5">Stok</th>
                        <th class="px-8 py-5">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/50">
                    <!-- LOOPING DATA ASLI DARI DATABASE -->
                    <!-- Menggunakan variable $recent_items yang dikirim dari controller -->
                    @forelse($recent_items as $item)
                    <tr class="hover:bg-white/50 transition-colors group">
                        <!-- Nama & Part Number -->
                        <td class="px-8 py-5">
                            <span class="font-bold text-slate-700 font-display text-base block group-hover:text-indigo-600 transition-colors">{{ $item->name }}</span>
                            <span class="text-xs text-slate-400 font-medium font-sans">{{ $item->part_number }}</span>
                        </td>
                        
                        <!-- Kategori -->
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 bg-white/60 border border-slate-200 rounded-lg text-xs font-semibold shadow-sm text-slate-600">
                                {{ $item->category->name ?? '-' }}
                            </span>
                        </td>
                        
                        <!-- Stok -->
                        <td class="px-8 py-5 font-medium text-slate-600">
                            {{ $item->stock }} <span class="text-xs text-slate-400">{{ $item->unit ?? 'Pcs' }}</span>
                        </td>
                        
                        <!-- Status Stok -->
                        <td class="px-8 py-5">
                            @if($item->stock <= $item->min_stock)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-100/50 text-red-700 border border-red-100">
                                     <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> Kritis
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100/50 text-emerald-700 border border-emerald-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aman
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-8 text-center text-slate-500 italic">
                            Belum ada barang yang ditambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection