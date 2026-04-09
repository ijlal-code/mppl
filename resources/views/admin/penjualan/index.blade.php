<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    
                    <table class="w-full text-sm text-left text-gray-500 border">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Tanggal</th>
                                <th scope="col" class="px-6 py-3">Kasir</th>
                                <th scope="col" class="px-6 py-3">Barang</th>
                                <th scope="col" class="px-6 py-3">Harga Satuan</th>
                                <th scope="col" class="px-6 py-3">Jumlah</th>
                                <th scope="col" class="px-6 py-3">Total Harga</th>
                                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penjualans as $index => $penjualan)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        {{ $penjualans->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($penjualan->tanggal)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $penjualan->user->name ?? 'Kasir Dihapus' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $penjualan->produk->nama_barang ?? 'Barang Dihapus' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp {{ number_format($penjualan->produk->harga ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $penjualan->jumlah }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-900">
                                        Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 flex justify-center space-x-2">
                                        <a href="{{ route('admin.penjualan.edit', $penjualan->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-xs">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.penjualan.destroy', $penjualan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data transaksi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                        Belum ada data penjualan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $penjualans->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>