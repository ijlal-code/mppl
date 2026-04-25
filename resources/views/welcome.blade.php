<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AyamKu - Penjualan</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">

<div class="p-6 flex justify-end space-x-4">
    @auth
        <a href="/dashboard" class="text-blue-600 font-bold">Dashboard</a>
    @else
        <a href="{{ route('login') }}" class="text-blue-600 font-bold">Login</a>
    @endauth
</div>

<h1 class="text-3xl font-bold text-center mb-8">
    🍗 Menu Ayam Spesial
</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-10">

@foreach($produks as $produk)
    <div class="bg-white p-4 rounded-xl shadow">
        
        <img src="{{ asset('images/'.$produk->gambar) }}" class="w-full h-40 object-cover rounded">

        <h2 class="text-xl font-bold mt-3">
            {{ $produk->nama_makanan }}
        </h2>

        <p class="text-gray-600">
            Jenis: {{ $produk->jenis_makanan }}
        </p>

        <p class="text-green-600 font-bold">
            Rp {{ number_format($produk->harga) }}
        </p>

        <p class="text-sm text-gray-500">
            Stok: {{ $produk->stok }}
        </p>

       

    </div>
@endforeach

</div>

</body>
</html>