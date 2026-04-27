<x-app-layout>
    <div class="bg-white shadow-xl border border-gray-100 sm:rounded-2xl overflow-hidden mt-6">
        
    
        <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center bg-gradient-to-r from-green-50 to-white gap-4">
            <h2 class="text-xl font-extrabold text-green-800">Daftar Penjualan Keseluruhan</h2>
            
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                <form action="{{ route('admin.penjualan.index') }}" method="GET" class="flex items-center gap-2">
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 text-sm py-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition shadow-sm text-sm">
                        Filter
                    </button>
                    @if(request('tanggal'))
                        <a href="{{ route('admin.penjualan.index') }}" class="px-4 py-2 bg-gray-500 text-white font-bold rounded-lg hover:bg-gray-600 transition shadow-sm text-sm">
                            Reset
                        </a>
                    @endif
                </form>

                <a href="{{ route('admin.penjualan.create') }}" class="px-4 py-2 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition shadow-sm whitespace-nowrap text-sm">
                    + Tambah Data
                </a>
            </div>
        </div>
        
        <div class="p-6 overflow-x-auto">
            @if(session('success'))
                <div class="mb-4 p-4 text-green-800 bg-green-100 border border-green-200 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full text-sm text-left text-gray-700 border border-green-100 rounded-lg overflow-hidden">
                <thead class="text-xs text-white uppercase bg-green-700">
                    <tr>
                        <th class="px-6 py-4 rounded-tl-lg text-center">No</th>
                        <th class="px-6 py-4 text-center">Gambar</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Penanggung Jawab</th>
                        <th class="px-6 py-4">Nama Barang</th>
                        <th class="px-6 py-4 text-right">Harga Satuan</th>
                        <th class="px-6 py-4 text-center">Jumlah</th>
                        <th class="px-6 py-4 text-right">Total Pendapatan</th>
                        <th class="px-6 py-4 text-center rounded-tr-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-green-50">
                    @forelse($penjualans as $index => $penjualan)
                    <tr class="bg-white hover:bg-green-50 transition-colors">
                        <td class="px-6 py-4 font-bold text-green-800 text-center align-middle">{{ $penjualans->firstItem() + $index }}</td>
                        
                        <td class="px-6 py-4 align-middle">
                            <div class="flex justify-center">
                                @if($penjualan->foto_barang)
                                    <img src="{{ asset('storage/' . $penjualan->foto_barang) }}" alt="Foto Barang" class="h-14 w-14 object-cover rounded-lg border border-gray-200 shadow-sm">
                                @else
                                    <div class="h-14 w-14 flex items-center justify-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                        <span class="text-[10px] text-gray-400 font-bold uppercase text-center leading-tight">Tidak Ada<br>Foto</span>
                                    </div>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4 align-middle">{{ \Carbon\Carbon::parse($penjualan->tanggal)->format('d-M-Y') }}</td>
                        <td class="px-6 py-4 align-middle">
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">
                                {{ $penjualan->user->name ?? 'Dihapus' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 align-middle">{{ $penjualan->nama_barang }}</td>
                        <td class="px-6 py-4 text-gray-600 font-medium text-right align-middle">Rp {{ number_format($penjualan->harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center font-extrabold text-gray-800 align-middle">{{ $penjualan->jumlah }}</td>
                        <td class="px-6 py-4 font-extrabold text-green-700 text-right align-middle">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 align-middle">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.penjualan.edit', $penjualan->id) }}" class="px-3 py-1.5 bg-yellow-100 text-yellow-700 border border-yellow-200 rounded-md hover:bg-yellow-500 hover:text-white transition-colors text-xs font-bold shadow-sm">
                                    EDIT
                                </a>

                                <form action="{{ route('admin.penjualan.destroy', $penjualan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat transaksi ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-red-100 text-red-700 border border-red-200 rounded-md hover:bg-red-600 hover:text-white transition-colors text-xs font-bold shadow-sm">
                                        HAPUS
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-6 text-center text-gray-500 font-semibold bg-white">
                            Tidak ada data penjualan pada tanggal ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="mt-6">
                {{ $penjualans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>