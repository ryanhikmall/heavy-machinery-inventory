<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Atlas Inventory') }}</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .font-display { font-family: 'Space Grotesk', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .fade-in { animation: fadeIn 0.5s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        
        /* Glass Effect Helpers */
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        
        /* Animasi Background Blobs */
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob { animation: blob 10s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        
        /* Hide element initially to prevent flicker with Alpine.js */
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="text-slate-600 relative bg-slate-50" x-data="{ sidebarOpen: false }">

    <!-- 1. BACKGROUND ANIMATION -->
    <div class="fixed inset-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 animate-blob"></div>
        <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-[-20%] left-[20%] w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 animate-blob animation-delay-4000"></div>
    </div>

    <!-- 2. SIDEBAR -->
    <aside class="fixed inset-y-0 left-0 z-50 w-64 glass-panel border-r shadow-[4px_0_24px_rgba(0,0,0,0.02)] transition-transform duration-300 ease-in-out transform lg:translate-x-0 bg-white/80"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        
        <!-- Logo -->
        <div class="h-20 flex items-center justify-center border-b border-slate-100/50">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                <div class="transition-transform duration-300 group-hover:scale-110">
                    <!-- Logo SVG -->
                    <svg width="40" height="40" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 80 H80 L70 60 H30 L20 80Z" fill="#1e293b"/> 
                        <path d="M35 55 H65 L60 40 H40 L35 55Z" fill="#475569"/>
                        <path d="M45 35 H55 L50 20 L45 35Z" fill="#6366f1"/> 
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-bold font-display text-slate-800 leading-none tracking-wide">ATLAS</span>
                    <span class="text-[10px] font-bold text-slate-400 tracking-[0.2em] uppercase mt-1">Inventory</span>
                </div>
            </a>
            <button @click="sidebarOpen = false" class="lg:hidden absolute right-4 text-slate-400 hover:text-slate-600">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Menu -->
        <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-5rem)] sidebar-scroll">
            <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">Menu Utama</div>

            @auth
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all duration-300 group {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm' : 'text-slate-500 hover:bg-white hover:text-indigo-600 hover:shadow-sm' }}">
                    <i class="fas fa-home w-5 text-center {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-600' }}"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Master Data -->
                <div x-data="{ open: {{ request()->routeIs('categories.*') || request()->routeIs('units.*') || request()->routeIs('spareparts.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" 
                            class="w-full flex items-center justify-between px-3 py-3 rounded-xl transition-all duration-300 group {{ request()->routeIs('categories.*') || request()->routeIs('units.*') || request()->routeIs('spareparts.*') ? 'bg-indigo-50/50 text-indigo-600 font-medium' : 'text-slate-500 hover:bg-white hover:text-indigo-600 hover:shadow-sm' }}">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-database w-5 text-center {{ request()->routeIs('categories.*') || request()->routeIs('units.*') || request()->routeIs('spareparts.*') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-600' }}"></i>
                            <span>Master Data</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="{'rotate-180': open}"></i>
                    </button>
                    
                    <div x-show="open" x-collapse class="pl-11 pr-3 py-2 space-y-1">
                        <a href="{{ route('categories.index') }}" class="block px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('categories.*') ? 'text-indigo-600 bg-indigo-50 font-medium' : 'text-slate-500 hover:text-indigo-600' }}">Kategori</a>
                        <a href="{{ route('units.index') }}" class="block px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('units.*') ? 'text-indigo-600 bg-indigo-50 font-medium' : 'text-slate-500 hover:text-indigo-600' }}">Unit Alat Berat</a>
                        <a href="{{ route('spareparts.index') }}" class="block px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('spareparts.*') ? 'text-indigo-600 bg-indigo-50 font-medium' : 'text-slate-500 hover:text-indigo-600' }}">Data Sparepart</a>
                    </div>
                </div>

                <!-- Transaksi -->
                <a href="{{ route('transactions.index') }}" 
                   class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all duration-300 group {{ request()->routeIs('transactions.*') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm' : 'text-slate-500 hover:bg-white hover:text-indigo-600 hover:shadow-sm' }}">
                    <i class="fas fa-exchange-alt w-5 text-center {{ request()->routeIs('transactions.*') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-600' }}"></i>
                    <span>Transaksi</span>
                </a>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-slate-500 hover:bg-white hover:text-indigo-600 hover:shadow-sm transition-all duration-300 group">
                    <i class="fas fa-sign-in-alt w-5 text-center text-slate-400 group-hover:text-indigo-600"></i>
                    <span>Login</span>
                </a>
            @endguest
        </nav>

        <!-- Profile Bottom -->
        @auth
        <div class="absolute bottom-0 left-0 w-full p-4 border-t border-slate-100/50 bg-white/50 backdrop-blur-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm shadow-md ring-2 ring-white">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold truncate">{{ Auth::user()->role }}</p>
                </div>
                
                <!-- Logout Form -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors" title="Logout">
                        <i class="fas fa-power-off"></i>
                    </button>
                </form>
            </div>
        </div>
        @endauth
    </aside>

    <!-- 3. MAIN WRAPPER -->
    <div class="lg:ml-64 flex flex-col min-h-screen transition-all duration-300">
        
        <!-- Navbar Header -->
        <header class="h-20 px-6 sm:px-8 flex items-center justify-between sticky top-0 z-30 glass-panel bg-white/70 border-b border-slate-100/50 shadow-sm">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 text-slate-500 hover:text-slate-700">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h1 class="text-xl font-bold font-display text-slate-800 tracking-tight">
                    @if(request()->routeIs('dashboard')) Dashboard Overview
                    @elseif(request()->routeIs('categories.*')) Manajemen Kategori
                    @elseif(request()->routeIs('units.*')) Unit Alat Berat
                    @elseif(request()->routeIs('spareparts.*')) Stok Sparepart
                    @elseif(request()->routeIs('transactions.*')) Riwayat Transaksi
                    @else Dashboard
                    @endif
                </h1>
            </div>

            <!-- Notification Bell -->
            <div class="flex items-center gap-4">
                @auth
                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    
                    <!-- 1. Tombol Lonceng -->
                    <button @click="open = !open" class="w-10 h-10 rounded-full flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:bg-white/50 transition-all relative outline-none focus:outline-none">
                        <i class="fas fa-bell text-lg"></i>
                        
                        <!-- Indikator Merah (Hanya jika ada unread) -->
                        @if(auth()->user()->unreadNotifications && auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute top-2 right-2.5 flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 border border-white"></span>
                            </span>
                        @endif
                    </button>

                    <!-- 2. Dropdown Notifikasi -->
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-cloak
                         class="absolute right-0 mt-3 w-80 bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/50 ring-1 ring-black/5 overflow-hidden z-[100]">
                        
                        <!-- Header Dropdown -->
                        <div class="px-4 py-3 border-b border-slate-100/50 bg-slate-50/80 flex justify-between items-center">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Notifikasi</span>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="text-[10px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold">{{ auth()->user()->unreadNotifications->count() }} Baru</span>
                            @endif
                        </div>

                        <!-- List Notifikasi -->
                        <div class="max-h-80 overflow-y-auto">
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <!-- LOGIC PENTING: Link mengarah ke route 'notifications.read' agar ditandai READ saat diklik -->
                                <a href="{{ route('notifications.read', $notification->id) }}" class="block px-4 py-3 hover:bg-indigo-50/50 transition-colors border-b border-slate-100/50 last:border-0 group">
                                    <div class="flex items-start gap-3">
                                        <div class="p-2 bg-amber-100 text-amber-600 rounded-full shrink-0 group-hover:bg-amber-200 transition-colors">
                                            <i class="{{ $notification->data['icon'] ?? 'fas fa-info-circle' }} text-xs"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-slate-700 truncate">{{ $notification->data['title'] }}</p>
                                            <p class="text-xs text-slate-500 mt-0.5 line-clamp-2">{{ $notification->data['message'] }}</p>
                                            <p class="text-[10px] text-slate-400 mt-1 font-mono">{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="px-4 py-8 text-center text-slate-400 flex flex-col items-center justify-center">
                                    <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mb-2">
                                        <i class="fas fa-bell-slash text-xl opacity-40"></i>
                                    </div>
                                    <p class="text-xs font-medium">Tidak ada notifikasi baru.</p>
                                </div>
                            @endforelse
                        </div>
                        
                        <!-- LOGIC PENTING: Tombol Tandai Semua Sudah Dibaca (POST Form) -->
                        @if(auth()->user()->unreadNotifications->count() > 0)
                        <div class="bg-slate-50/80 border-t border-slate-100/50 p-2 text-center">
                            <form action="{{ route('notifications.readAll') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-[10px] font-bold text-indigo-600 hover:text-indigo-800 transition-colors uppercase tracking-wider w-full py-1 hover:bg-indigo-50 rounded">
                                    Tandai Semua Sudah Dibaca
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                @endauth
            </div>
        </header>

        <!-- Dynamic Content -->
        <main class="flex-1 p-6 sm:p-8 fade-in relative z-0">
            <!-- Flash Message Success -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-50/80 backdrop-blur-sm border border-emerald-100 text-emerald-700 flex items-center justify-between shadow-sm" role="alert" x-data="{ show: true }" x-show="show">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-emerald-100 rounded-full text-emerald-600"><i class="fas fa-check"></i></div>
                        <span class="font-medium text-sm">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-emerald-400 hover:text-emerald-600"><i class="fas fa-times"></i></button>
                </div>
            @endif

            <!-- Flash Message Error -->
            @if(session('error'))
                <div class="mb-6 p-4 rounded-2xl bg-red-50/80 backdrop-blur-sm border border-red-100 text-red-700 flex items-center justify-between shadow-sm" role="alert" x-data="{ show: true }" x-show="show">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-red-100 rounded-full text-red-600"><i class="fas fa-exclamation-triangle"></i></div>
                        <span class="font-medium text-sm">{{ session('error') }}</span>
                    </div>
                    <button @click="show = false" class="text-red-400 hover:text-red-600"><i class="fas fa-times"></i></button>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-6 text-center text-xs text-slate-400 font-medium border-t border-slate-200/50 bg-white/30 backdrop-blur-sm">
            &copy; {{ date('Y') }} Atlas Heavy Inventory System.
        </footer>
    </div>

</body>
</html>