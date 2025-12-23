@extends('layouts.app')

@section('title', 'Dashboard Overview')

@section('content')
    <div class="mb-10">
        <h2 class="text-3xl font-bold font-display text-slate-800 mb-2 tracking-tight">
            Halo, {{ Auth::user()->name ?? 'User' }}! 👋
        </h2>
        <p class="text-slate-500 font-medium">
            Selamat datang kembali, {{ ucfirst(Auth::user()->role ?? 'Staff') }}. Berikut adalah ringkasan inventaris hari ini.
        </p>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        
        <div class="bg-white/60 backdrop-blur-xl rounded-[2rem] p-8 shadow-[0_10px_30px_rgb(0,0,0,0.04)] border border-white/50 relative overflow-hidden group hover:-translate-y-1 transition-all duration-300">
            <div class="flex justify-between items-start z-10 relative">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Total Jenis Barang</p>
                    <h3 class="text-4xl font-bold font-display text-slate-800">{{ $total_items ?? '1,240' }}</h3>
                </div>
                <div class="w-12 h-12 bg-white/80 rounded-2xl flex items-center justify-center text-indigo-600 shadow-sm ring-1 ring-slate-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
            </div>
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-gradient-to-br from-indigo-100 to-transparent rounded-full opacity-50 blur-2xl group-hover:scale-110 transition-transform duration-500"></div>
        </div>

        <div class="bg-white/60 backdrop-blur-xl rounded-[2rem] p-8 shadow-[0_10px_30px_rgb(0,0,0,0.04)] border border-white/50 relative overflow-hidden group hover:-translate-y-1 transition-all duration-300">
            <div class="flex justify-between items-start z-10 relative">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Perlu Restock</p>
                    <h3 class="text-4xl font-bold font-display text-slate-800">{{ $low_stock ?? '12' }}</h3>
                    <div class="mt-2 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-red-50 text-red-600 border border-red-100">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <span class="text-[10px] font-bold uppercase tracking-wide">Stok Kritis</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-white/80 rounded-2xl flex items-center justify-center text-red-500 shadow-sm ring-1 ring-slate-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-gradient-to-br from-red-100 to-transparent rounded-full opacity-50 blur-2xl group-hover:scale-110 transition-transform duration-500"></div>
        </div>

        <div class="bg-white/60 backdrop-blur-xl rounded-[2rem] p-8 shadow-[0_10px_30px_rgb(0,0,0,0.04)] border border-white/50 relative overflow-hidden group hover:-translate-y-1 transition-all duration-300 hidden md:block">
            <div class="flex justify-between items-start z-10 relative">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Total Nilai Aset</p>
                    <h3 class="text-4xl font-bold font-display text-slate-800">Rp 450jt</h3>
                    <div class="mt-2 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        <span class="text-[10px] font-bold uppercase tracking-wide">+2.5% Profit</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-white/80 rounded-2xl flex items-center justify-center text-emerald-600 shadow-sm ring-1 ring-slate-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
             <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-gradient-to-br from-emerald-100 to-transparent rounded-full opacity-50 blur-2xl group-hover:scale-110 transition-transform duration-500"></div>
        </div>

    </div>

    <div class="bg-white/60 backdrop-blur-xl rounded-[2rem] border border-white/50 shadow-[0_20px_50px_rgb(0,0,0,0.05)] overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-100/50 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 font-display tracking-tight text-lg">Barang Baru Ditambahkan</h3>
            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700 font-bold tracking-wide">Lihat Semua</a>
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
                    <tr class="hover:bg-white/50 transition-colors group">
                        <td class="px-8 py-5 font-bold text-slate-700 font-display group-hover:text-indigo-600 transition-colors">Macbook Pro M2</td>
                        <td class="px-8 py-5"><span class="px-3 py-1 bg-white border border-slate-100 rounded-lg text-xs font-semibold shadow-sm">Elektronik</span></td>
                        <td class="px-8 py-5 font-medium">15 Unit</td>
                        <td class="px-8 py-5"><span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100/50 text-emerald-700 border border-emerald-100">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aman
                        </span></td>
                    </tr>
                    <tr class="hover:bg-white/50 transition-colors group">
                        <td class="px-8 py-5 font-bold text-slate-700 font-display group-hover:text-indigo-600 transition-colors">Keyboard Mechanical</td>
                        <td class="px-8 py-5"><span class="px-3 py-1 bg-white border border-slate-100 rounded-lg text-xs font-semibold shadow-sm">Aksesoris</span></td>
                        <td class="px-8 py-5 font-medium">3 Unit</td>
                        <td class="px-8 py-5"><span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-100/50 text-red-700 border border-red-100">
                             <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Kritis
                        </span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection