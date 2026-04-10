<x-app-layout>
    <div class="bg-white shadow-xl border border-gray-100 sm:rounded-2xl overflow-hidden mt-6">
        
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gradient-to-r from-green-50 to-white">
            <h2 class="text-xl font-extrabold text-green-800">Daftar Penjualan Keseluruhan</h2>
            <a href="{{ route('admin.penjualan.create') }}" class="px-4 py-2 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition">
                + Tambah Data
            </a>
        </div>
        
        <div class="p-6 overflow-x-auto">
            @if(session('success'))
                <div class="mb-4 p-4 text-green-800 bg-green-100 border border-green-200 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full text-sm text-left text-gray-700 border border-green-100 rounded-lg overflow-hidden">
                <thead class="text-xs text-white uppercase bg-green-700">
                    <tr>
                        <th class="px-6 py-4 rounded-tl-lg">No</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Penanggung Jawab</th>
                        <th class="px-6 py-4">Nama Barang</th>
                        <th class="px-6 py-4">Harga Satuan</th>
                        <th class="px-6 py-4 text-center">Jumlah</th>
                        <th class="px-6 py-4">Total Pendapatan</th>
                        <th class="px-6 py-4 text-center rounded-tr-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-green-50">
                    @foreach($penjualans as $index => $penjualan)
                    <tr class="bg-white hover:bg-green-50 transition-colors">
                        <td class="px-6 py-4 font-bold text-green-800">{{ $penjualans->firstItem() + $index }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($penjualan->tanggal)->format('d-M-Y') }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">
                                {{ $penjualan->user->name ?? 'Dihapus' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-semibold">{{ $penjualan->nama_barang }}</td>
                        <td class="px-6 py-4 text-gray-600">Rp {{ number_format($penjualan->harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center font-bold">{{ $penjualan->jumlah }}</td>
                        <td class="px-6 py-4 font-extrabold text-green-700">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 flex justify-center gap-2">
                            <a href="{{ route('admin.penjualan.edit', $penjualan->id) }}" class="px-3 py-1 bg-yellow-100 text-yellow-600 border border-yellow-200 rounded hover:bg-yellow-500 hover:text-white transition-colors text-xs font-bold">
                                EDIT
                            </a>

                            <form action="{{ route('admin.penjualan.destroy', $penjualan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat transaksi ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-100 text-red-600 border border-red-200 rounded hover:bg-red-600 hover:text-white transition-colors text-xs font-bold">
                                    HAPUS
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="mt-6">
                {{ $penjualans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>