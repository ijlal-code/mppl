<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menu Makanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Daftar Menu Makanan</h1>
            <a href="{{ route('login') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Login Admin</a>
        </div>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-200 text-red-800 p-4 rounded mb-4">{{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($produks as $produk)
            <div class="bg-white rounded-lg shadow-md p-4">
                <img src="{{ asset('images/'.$produk->gambar) }}" alt="{{ $produk->nama_makanan }}" class="w-full h-48 object-cover rounded-md mb-4 bg-gray-200">
                <h2 class="text-xl font-bold">{{ $produk->nama_makanan }}</h2>
                <p class="text-gray-600 mb-1">Jenis: {{ $produk->jenis_makanan }}</p>
                <p class="text-blue-600 font-bold mb-1">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                
                @if($produk->stok > 0)
                    <p class="text-sm text-green-600 mb-4">Stok Tersedia: {{ $produk->stok }}</p>
                    <a href="{{ route('pesan.create', $produk->id) }}" class="block w-full text-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Pilih Pesan Makanan</a>
                @else
                    <p class="text-sm text-red-600 mb-4 font-bold">STOK HABIS</p>
                    <button disabled class="block w-full text-center bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed">Tidak Bisa Dipesan</button>
                @endif
            </div>
            @endforeach
        </div>
    </div>

</body>
</html>