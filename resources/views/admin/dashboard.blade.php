<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Admin</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500">Total Transaksi</h3>
                    <p class="text-2xl font-bold">{{ $totalTransaksi }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500">Barang Terjual</h3>
                    <p class="text-2xl font-bold">{{ $totalBarang }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500">Total Keuntungan</h3>
                    <p class="text-2xl font-bold text-green-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500">Transaksi Hari Ini</h3>
                    <p class="text-2xl font-bold">{{ $hariIni }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">10 Transaksi Terakhir</h3>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2">Tanggal</th>
                            <th class="p-2">Kasir</th>
                            <th class="p-2">Barang</th>
                            <th class="p-2">Jml</th>
                            <th class="p-2">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr class="border-b">
                            <td class="p-2">{{ $item->tanggal }}</td>
                            <td class="p-2">{{ $item->user->name }}</td>
                            <td class="p-2">{{ $item->nama_barang }}</td>
                            <td class="p-2">{{ $item->jumlah }}</td>
                            <td class="p-2">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    <a href="{{ route('admin.penjualan.index') }}" class="text-blue-500 hover:underline">Lihat Semua Data -></a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>