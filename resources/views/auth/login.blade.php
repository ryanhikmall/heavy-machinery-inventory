<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Atlas Inventory</title>
    
    <!-- Menggunakan Tailwind CSS via CDN untuk kemudahan (Production sebaiknya via npm) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Inter (Standar Modern UI) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc; /* Slate-50 */
        }
        
        /* Animasi Loading Spinner */
        .loader {
            border: 2px solid #f3f3f3;
            border-top: 2px solid #ffffff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: inline-block;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Smooth Fade In saat halaman dibuka */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="h-screen w-full flex items-center justify-center relative overflow-hidden">

    <!-- Dekorasi Latar Belakang (Abstrak) -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
        <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-[-20%] left-[20%] w-96 h-96 bg-slate-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Container Utama -->
    <div class="w-full max-w-md p-6 fade-in">
        
        <!-- Kartu Login -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 sm:p-10 relative">
            
            <!-- Header & Logo Atlas -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <!-- Logo Minimalis Atlas (SVG) -->
                    <div class="bg-slate-900 p-3 rounded-xl shadow-lg">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 22H22L12 2Z" fill="white" stroke="white" stroke-width="2" stroke-linejoin="round"/>
                            <path d="M12 6L6 18H18L12 6Z" fill="#0f172a"/> 
                        </svg>
                    </div>
                </div>
                <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Atlas System</h2>
                <p class="text-sm text-slate-500 mt-2">Masuk untuk mengelola inventory Anda</p>
            </div>

            <!-- Form Login -->
            <form action="{{ route('login.post') }}" method="POST" id="loginForm">
                @csrf

                <!-- Input Email -->
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" 
                               class="pl-10 block w-full rounded-lg border-gray-300 bg-gray-50 border focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 transition duration-200 @error('email') border-red-500 ring-red-100 @enderror" 
                               placeholder="nama@perusahaan.com" 
                               value="{{ old('email') }}" 
                               required autofocus>
                    </div>
                    @error('email')
                        <p class="mt-1 text-xs text-red-500 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Input Password -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-1">
                        <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                        <!-- Opsi Lupa Password (Opsional) -->
                        <a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-500">Lupa password?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="password" 
                               class="pl-10 block w-full rounded-lg border-gray-300 bg-gray-50 border focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 transition duration-200" 
                               placeholder="••••••••" 
                               required>
                    </div>
                </div>

                <!-- Tombol Submit dengan Loading -->
                <button type="submit" id="btnSubmit" class="group relative w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-semibold rounded-lg text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <span id="btnText">Masuk ke Dashboard</span>
                    <span id="btnLoader" class="loader ml-2 hidden"></span>
                </button>

            </form>

            <!-- Footer / Seed Info -->
            <div class="mt-6 text-center border-t border-gray-100 pt-4">
                <p class="text-xs text-slate-400">
                    Sistem Informasi &copy; {{ date('Y') }} Atlas Corp.
                </p>
            </div>
        </div>
        
        <!-- Pesan kecil di luar kartu -->
        <p class="text-center text-xs text-slate-400 mt-4">
            Butuh bantuan? <a href="#" class="text-indigo-500 hover:underline">Hubungi IT Support</a>
        </p>

    </div>

    <!-- Script untuk efek Loading -->
    <script>
        const form = document.getElementById('loginForm');
        const btnSubmit = document.getElementById('btnSubmit');
        const btnText = document.getElementById('btnText');
        const btnLoader = document.getElementById('btnLoader');

        form.addEventListener('submit', function() {
            // Disable tombol agar tidak double submit
            btnSubmit.disabled = true;
            btnSubmit.classList.add('opacity-75', 'cursor-not-allowed');
            
            // Ubah teks dan munculkan loader
            btnText.textContent = 'Memproses...';
            btnLoader.classList.remove('hidden');
        });
    </script>

</body>
</html>