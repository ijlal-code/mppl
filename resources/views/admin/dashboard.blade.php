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
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800">10 Transaksi Terakhir</h3>
                    <a href="{{ route('admin.penjualan.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Data
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50 text-gray-700 text-sm">
                                <th class="p-3 font-semibold text-center w-12">No</th>
                                <th class="p-3 font-semibold">Tanggal</th>
                                <!-- <th class="p-3 font-semibold text-center">Gambar</th> -->
                                <th class="p-3 font-semibold">Kasir</th>
                                <th class="p-3 font-semibold">Barang</th>
                                <th class="p-3 font-semibold text-center">Jumlah barang</th>
                                <th class="p-3 font-semibold">Total Harga</th>
                                <th class="p-3 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="p-3 text-sm text-gray-600 align-middle text-center font-medium">{{ $loop->iteration }}</td>
                                
                                <td class="p-3 text-sm text-gray-600 align-middle">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                
                                <!-- <td class="p-3 align-middle">
                                    <div class="flex justify-center">
                                        @if($item->foto_barang)
                                            <img src="{{ asset('storage/' . $item->foto_barang) }}" alt="Foto" class="h-12 w-12 object-cover rounded-md border border-gray-200 shadow-sm">
                                        @else
                                            <div class="h-12 w-12 flex items-center justify-center bg-gray-50 rounded-md border border-dashed border-gray-300">
                                                <span class="text-[9px] text-gray-400 font-bold uppercase text-center leading-tight">Tidak Ada<br>Foto</span>
                                            </div>
                                        @endif
                                    </div>
                                </td> -->

                                <td class="p-3 text-sm text-gray-800 align-middle">{{ $item->user->name ?? 'Dihapus' }}</td>
                                <td class="p-3 text-sm font-medium text-gray-800 align-middle">{{ $item->nama_barang }}</td>
                                <td class="p-3 text-sm text-center font-bold text-gray-800 align-middle">{{ $item->jumlah }}</td>
                                <td class="p-3 text-sm font-bold text-green-600 align-middle">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                
                                <td class="p-3 text-sm align-middle text-center">
                                    <div class="flex items-center justify-center space-x-3">
                                        <a href="{{ route('admin.penjualan.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 transition-colors" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        
                                        <form action="{{ route('admin.penjualan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
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