<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Input Penjualan (Kasir)</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-4 rounded mb-4">{{ session('success') }}</div>
                @endif

                <form action="{{ route('kasir.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label>Nama Barang</label>
                        <select name="produk_id" class="w-full border-gray-300 rounded-md" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($produks as $produk)
                                <option value="{{ $produk->id }}">{{ $produk->nama_barang }} (Rp {{ number_format($produk->harga, 0, ',', '.') }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Jumlah Terjual</label>
                        <input type="number" name="jumlah" min="1" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Transaksi</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>