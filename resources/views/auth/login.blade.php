<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Atlas Inventory</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Inter & Space Grotesk -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        /* --- NEW LOGO CONSTRUCTION ANIMATION --- */
        /* 1. Base (Bottom Layer) - Slide Up & Fade In */
        .logo-part-1 {
            opacity: 0;
            transform: translateY(20px);
            animation: constructBase 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            animation-delay: 0.3s;
        }

        /* 2. Middle (Center Layer) - Drop Down & Bounce */
        .logo-part-2 {
            opacity: 0;
            transform: translateY(-40px) scale(0.9);
            animation: constructStack 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            animation-delay: 0.6s;
        }

        /* 3. Top (Peak Layer) - Drop with slight rotation reset */
        .logo-part-3 {
            opacity: 0;
            transform: translateY(-50px);
            animation: constructPeak 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            animation-delay: 0.9s;
        }

        @keyframes constructBase {
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes constructStack {
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes constructPeak {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Shine Effect passing through logo */
        .logo-shine {
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.8), transparent);
            transform: skewX(-25deg);
            animation: shinePass 2.5s infinite;
            animation-delay: 2s; /* Start after construction */
        }
        
        @keyframes shinePass {
            0% { left: -100%; opacity: 0; }
            50% { opacity: 0.5; }
            100% { left: 200%; opacity: 0; }
        }

        /* --- TEXT ANIMATION --- */
        .text-mask {
            clip-path: inset(0 100% 0 0);
            animation: revealText 1s cubic-bezier(0.77, 0, 0.175, 1) forwards;
            animation-delay: 1.4s;
        }
        
        @keyframes revealText {
            to { clip-path: inset(0 0 0 0); }
        }

        /* --- PRELOADER EXIT --- */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: opacity 0.8s cubic-bezier(0.7, 0, 0.3, 1), visibility 0.8s;
        }

        #preloader.finished {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        /* --- FORM ENTRANCE --- */
        .login-container {
            opacity: 0;
            transform: translateY(40px) scale(0.98);
            transition: all 1s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .login-container.show {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* Background Blobs */
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 10s infinite;
        }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }

        /* Spinner */
        .spinner {
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top: 2px solid #fff;
            width: 16px;
            height: 16px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body class="h-screen w-full flex items-center justify-center relative overflow-hidden bg-slate-50">

    <!-- 1. PRELOADER SCREEN (NEW ANIMATION) -->
    <div id="preloader">
        <div class="relative w-28 h-28 mb-8 flex justify-center items-center overflow-hidden p-2">
            <!-- Shine Container -->
            <div class="absolute inset-0 z-10 logo-shine"></div>
            
            <!-- NEW LOGO: The Stacked "A" (Inventory Layers) -->
            <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="z-20">
                <!-- Part 1: Base (Foundation) - Darkest -->
                <path class="logo-part-1" d="M20 80 H80 L70 60 H30 L20 80Z" fill="#1e293b"/> 
                
                <!-- Part 2: Middle (Structure) - Medium Tone -->
                <path class="logo-part-2" d="M35 55 H65 L60 40 H40 L35 55Z" fill="#475569"/>
                
                <!-- Part 3: Top (Peak/Vision) - Accent Color -->
                <path class="logo-part-3" d="M45 35 H55 L50 20 L45 35Z" fill="#6366f1"/> 
            </svg>
        </div>
        
        <div class="flex flex-col items-center">
            <!-- Typography Reveal -->
            <div class="relative">
                <h1 class="text-3xl font-bold tracking-[0.3em] font-['Space_Grotesk'] text-slate-900 text-mask">ATLAS</h1>
            </div>
            <div class="mt-2 overflow-hidden">
                <p class="text-xs text-slate-400 tracking-widest uppercase text-mask" style="animation-delay: 1.6s">Intelligent Inventory</p>
            </div>
        </div>
    </div>

    <!-- 2. ANIMATED BACKGROUND -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-50 animate-blob"></div>
        <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-50 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-[-20%] left-[30%] w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-50 animate-blob animation-delay-4000"></div>
    </div>

    <!-- 3. LOGIN FORM (GLASSMORPHISM PRESERVED) -->
    <div class="w-full max-w-[400px] px-6 login-container" id="loginContainer">
        
        <div class="bg-white/60 backdrop-blur-xl rounded-[2rem] shadow-[0_20px_50px_rgb(0,0,0,0.05)] border border-white/50 p-8 sm:p-10 relative overflow-hidden ring-1 ring-white/70">
            
            <!-- Logo Header -->
            <div class="text-center mb-10">
                <div class="inline-flex justify-center items-center mb-6 relative group cursor-default">
                    <!-- Small Logo Version -->
                    <svg width="40" height="40" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="drop-shadow-sm transition-transform duration-500 group-hover:scale-110">
                        <path d="M20 80 H80 L70 60 H30 L20 80Z" fill="#1e293b"/> 
                        <path d="M35 55 H65 L60 40 H40 L35 55Z" fill="#475569"/>
                        <path d="M45 35 H55 L50 20 L45 35Z" fill="#6366f1"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-slate-800 font-['Space_Grotesk'] tracking-tight">Welcome Back</h2>
                <p class="text-sm text-slate-500 mt-2 font-medium">Masuk untuk mengelola inventory Anda</p>
            </div>

            <!-- Form -->
            <form action="{{ route('login.post') }}" method="POST" id="loginForm">
                @csrf

                <div class="mb-5 space-y-1.5">
                    <label for="email" class="text-xs font-bold text-slate-500 ml-1 uppercase tracking-wider">Email</label>
                    <div class="relative group">
                        <input type="email" name="email" id="email" 
                               class="block w-full rounded-xl border-0 bg-white/70 ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500/50 sm:text-sm py-3.5 px-4 transition-all duration-300 outline-none placeholder:text-slate-300 shadow-sm group-hover:bg-white" 
                               placeholder="name@atlas.com" 
                               value="{{ old('email') }}" 
                               required autofocus>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-300 group-focus-within:text-indigo-500 transition-colors">
                           <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        </div>
                    </div>
                    @error('email')
                        <p class="text-xs text-red-500 ml-1 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8 space-y-1.5">
                    <div class="flex justify-between items-center ml-1">
                        <label for="password" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Password</label>
                        <a href="#" class="text-xs font-semibold text-indigo-500 hover:text-indigo-600 transition-colors">Lupa Password?</a>
                    </div>
                    <div class="relative group">
                        <input type="password" name="password" id="password" 
                               class="block w-full rounded-xl border-0 bg-white/70 ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500/50 sm:text-sm py-3.5 px-4 transition-all duration-300 outline-none placeholder:text-slate-300 shadow-sm group-hover:bg-white" 
                               placeholder="••••••••" 
                               required>
                         <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-300 group-focus-within:text-indigo-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </div>
                    </div>
                </div>

                <button type="submit" id="btnSubmit" class="w-full py-4 px-4 rounded-xl text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-900/20 transition-all duration-300 shadow-xl shadow-slate-900/10 active:scale-[0.98] flex justify-center items-center space-x-2 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                    <span id="btnText">Sign In</span>
                    <span id="btnLoader" class="hidden"><div class="spinner"></div></span>
                </button>

            </form>

            <div class="mt-8 text-center">
                <p class="text-xs text-slate-400 font-medium">
                    &copy; {{ date('Y') }} Atlas System.
                </p>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            const loginContainer = document.getElementById('loginContainer');
            
            // Total durasi animasi loading (Logo Construct + Shine + Text)
            // Sekitar 3.5 detik untuk experience yang elegan
            setTimeout(() => {
                preloader.classList.add('finished');
                
                // Show Login Form
                setTimeout(() => {
                    loginContainer.classList.add('show');
                }, 400); // Sedikit delay setelah layar putih hilang
                
            }, 3200); 
        });

        // Form Submit Handler
        const form = document.getElementById('loginForm');
        const btnSubmit = document.getElementById('btnSubmit');
        const btnText = document.getElementById('btnText');
        const btnLoader = document.getElementById('btnLoader');

        form.addEventListener('submit', function() {
            btnSubmit.disabled = true;
            btnSubmit.classList.add('opacity-90', 'cursor-not-allowed');
            btnText.style.display = 'none';
            btnLoader.classList.remove('hidden');
        });
    </script>
</body>
</html>