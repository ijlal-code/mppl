<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Menu Ayam Favorit</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-50 text-gray-900 font-sans min-h-screen pb-12">
        
        <div class="w-full bg-white shadow-sm py-4 px-8 flex justify-between items-center">
            <div class="font-extrabold text-2xl text-orange-600 flex items-center gap-2">
                🍗 Kedai AyamKu
            </div>
            
            @if (Route::has('login'))
                <div>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="font-semibold text-white bg-blue-600 hover:bg-blue-700 px-5 py-2.5 rounded-lg transition duration-300">
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-blue-600 bg-gray-100 hover:bg-gray-200 px-5 py-2.5 rounded-lg transition duration-300">
                            Login Admin
                        </a>
                    @endauth
                </div>
            @endif
        </div>

        <div class="max-w-6xl mx-auto px-6 py-10">
            
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl tracking-tight mb-4">
                    Pesan Menu Ayam Spesial Kami!
                </h1>
                <p class="text-lg text-gray-500 max-w-2xl mx-auto">
                    Pilih menu ayam andalan kami di bawah ini. Cukup klik pesan, isi detail Anda, dan pesanan akan langsung dikonfirmasi oleh Admin tanpa perlu mendaftar akun.
                </p>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-8 text-center shadow-sm" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-8 text-center shadow-sm" role="alert">
                    <strong class="font-bold">Gagal!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                @if(isset($produks) && $produks->count() > 0)
                    @foreach($produks as $produk)
                        <div class="bg-white rounded-2xl shadow-md border border-gray-100 hover:shadow-xl transition duration-300 flex flex-col overflow-hidden group">
                            
                            <div class="relative h-56 bg-gray-200 overflow-hidden">
                                @if($produk->gambar)
                                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_makanan }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span class="text-sm">Belum ada gambar</span>
                                    </div>
                                @endif
                                
                                <span class="absolute top-4 right-4 bg-white/90 text-orange-600 font-bold px-3 py-1 rounded-full text-xs shadow">
                                    {{ $produk->jenis_makanan }}
                                </span>
                            </div>

                            <div class="p-6 flex flex-col flex-grow">
                                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $produk->nama_makanan }}</h2>
                                
                                <div class="flex justify-between items-center mb-6 mt-auto">
                                    <span class="text-2xl font-extrabold text-green-600">
                                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                    </span>
                                    
                                    @if($produk->stok > 0)
                                        <span class="text-sm font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md border border-blue-100">
                                            Sisa Stok: {{ $produk->stok }}
                                        </span>
                                    @else
                                        <span class="text-sm font-bold text-red-600 bg-red-50 px-2.5 py-1 rounded-md border border-red-100">
                                            Stok Habis
                                        </span>
                                    @endif
                                </div>

                                @if($produk->stok > 0)
                                    <a href="{{ route('pesan.form', $produk->id) }}" class="block w-full text-center px-4 py-3 font-bold text-white bg-orange-500 rounded-xl hover:bg-orange-600 hover:-translate-y-0.5 shadow-lg shadow-orange-500/30 transition duration-300">
                                        Pilih & Pesan Sekarang
                                    </a>
                                @else
                                    <button disabled class="w-full px-4 py-3 font-bold text-white bg-gray-400 rounded-xl cursor-not-allowed">
                                        Maaf, Stok Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-1 md:col-span-3 bg-white p-10 rounded-2xl shadow border border-gray-100 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <h3 class="text-xl font-bold text-gray-500">Belum Ada Menu Ayam Tersedia.</h3>
                        <p class="text-gray-400 mt-2">Silakan tunggu admin untuk menambahkan menu terlebih dahulu.</p>
                    </div>
                @endif

            </div>
        </div>
    </body>
</html>