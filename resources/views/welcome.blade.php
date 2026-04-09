<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistem POS Kasir & Admin</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-50 text-gray-900 font-sans">
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-blue-500 selection:text-white">
            
            <div class="absolute top-0 right-0 p-6 sm:fixed flex space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-blue-600 transition duration-300">
                            Dashboard Sistem
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-blue-600 transition duration-300">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-semibold text-gray-600 hover:text-blue-600 transition duration-300">Register</a>
                        @endif
                    @endauth
                @endif
            </div>

            <div class="max-w-4xl mx-auto px-6 py-12 text-center bg-white shadow-xl shadow-gray-200/50 rounded-2xl border border-gray-100">
                
                <div class="flex justify-center mb-8">
                    <div class="p-5 bg-blue-50 rounded-full">
                        <svg class="w-16 h-16 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>

                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl tracking-tight">
                    Sistem Point of Sale (POS)
                </h1>
                
                <p class="mt-4 text-lg text-gray-500 max-w-2xl mx-auto">
                    Aplikasi manajemen penjualan modern yang memisahkan otorisasi akses untuk Kasir dan Administrator. Kelola transaksi harian dan pantau laporan pendapatan dengan efisien.
                </p>

                <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                    <div class="p-6 border border-gray-100 rounded-xl bg-gray-50 hover:bg-blue-50 transition duration-300">
                        <div class="flex items-center space-x-3 mb-3">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <h3 class="text-xl font-bold text-gray-900">Peran Kasir</h3>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">Fokus pada operasional penjualan. Memilih barang, memasukkan jumlah produk yang dibeli, dan menyimpan data transaksi secara *real-time* ke dalam database sistem.</p>
                    </div>

                    <div class="p-6 border border-gray-100 rounded-xl bg-gray-50 hover:bg-blue-50 transition duration-300">
                        <div class="flex items-center space-x-3 mb-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                            <h3 class="text-xl font-bold text-gray-900">Peran Admin</h3>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">Fokus pada pemantauan dan pengelolaan. Mengakses *dashboard* ringkasan, melihat total omzet, mereview detail transaksi, dan melakukan manajemen data (Edit/Hapus).</p>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3 text-base font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition duration-300">
                        Masuk ke Sistem POS
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
            </div>

            <div class="mt-12 text-center text-sm font-medium text-gray-400">
                Sistem Point of Sale &copy; {{ date('Y') }} - Didesain untuk Tugas MPPL
            </div>
        </div>
    </body>
</html>