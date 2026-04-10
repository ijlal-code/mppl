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
                <h3 class="text-lg font-bold mb-4 text-gray-800">10 Transaksi Terakhir</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50 text-gray-700 text-sm">
                                <th class="p-3 font-semibold">Tanggal</th>
                                <th class="p-3 font-semibold text-center">Gambar</th>
                                <th class="p-3 font-semibold">Kasir</th>
                                <th class="p-3 font-semibold">Barang</th>
                                <th class="p-3 font-semibold text-center">Jml</th>
                                <th class="p-3 font-semibold">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="p-3 text-sm text-gray-600 align-middle">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                
                                <td class="p-3 align-middle">
                                    <div class="flex justify-center">
                                        @if($item->foto_barang)
                                            <img src="{{ asset('storage/' . $item->foto_barang) }}" alt="Foto" class="h-12 w-12 object-cover rounded-md border border-gray-200 shadow-sm">
                                        @else
                                            <div class="h-12 w-12 flex items-center justify-center bg-gray-50 rounded-md border border-dashed border-gray-300">
                                                <span class="text-[9px] text-gray-400 font-bold uppercase text-center leading-tight">Tidak Ada<br>Foto</span>
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                <td class="p-3 text-sm text-gray-800 align-middle">{{ $item->user->name ?? 'Dihapus' }}</td>
                                <td class="p-3 text-sm font-medium text-gray-800 align-middle">{{ $item->nama_barang }}</td>
                                <td class="p-3 text-sm text-center font-bold text-gray-800 align-middle">{{ $item->jumlah }}</td>
                                <td class="p-3 text-sm font-bold text-green-600 align-middle">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">
                    <a href="{{ route('admin.penjualan.index') }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors">
                        Lihat Semua Data 
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>