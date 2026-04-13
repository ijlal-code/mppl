<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pemesanan Ayam</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Menu Ayam Kami</h1>
            <a href="{{ route('login') }}" class="text-blue-500 font-semibold underline">Login Admin</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">{{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($produks as $produk)
            <div class="bg-white rounded-lg shadow p-4">
                @if($produk->gambar)
                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar" class="w-full h-48 object-cover rounded mb-4">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded mb-4">No Image</div>
                @endif
                
                <h2 class="text-xl font-bold">{{ $produk->nama_makanan }}</h2>
                <p class="text-sm text-gray-500 mb-2">Jenis: {{ $produk->jenis_makanan }}</p>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-lg font-semibold text-green-600">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                    <span class="text-sm font-bold {{ $produk->stok > 0 ? 'text-blue-500' : 'text-red-500' }}">
                        Stok: {{ $produk->stok > 0 ? $produk->stok : 'Habis' }}
                    </span>
                </div>

                @if($produk->stok > 0)
                    <a href="{{ route('pesan.create', $produk->id) }}" class="block w-full text-center bg-orange-500 hover:bg-orange-600 text-white py-2 rounded">Pesan Sekarang</a>
                @else
                    <button disabled class="w-full text-center bg-gray-400 text-white py-2 rounded cursor-not-allowed">Stok Habis</button>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>