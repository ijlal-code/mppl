<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h2 class="text-2xl font-extrabold text-gray-800 mb-6">Daftar Penjualan Keseluruhan</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-br from-green-600 to-green-700 p-6 rounded-2xl shadow-lg text-white">
                        <h4 class="text-green-100 text-xs font-bold uppercase tracking-wider">Total Pendapatan Filter</h4>
                        <p class="text-3xl font-black mt-1">Rp {{ number_format($stats['total_pendapatan'], 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                        <h4 class="text-gray-400 text-xs font-bold uppercase tracking-wider">Total Barang</h4>
                        <p class="text-3xl font-black text-gray-800 mt-1">{{ $stats['total_barang'] }} <span class="text-sm font-normal text-gray-500">Pcs</span></p>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                        <h4 class="text-gray-400 text-xs font-bold uppercase tracking-wider">Jumlah Transaksi</h4>
                        <p class="text-3xl font-black text-gray-800 mt-1">{{ $stats['total_transaksi'] }}</p>
                    </div>
                </div>
            </div>

           <div class="bg-white p-6 rounded-2xl shadow-sm mb-6 border border-gray-200">
    <form action="{{ route('admin.penjualan.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Barang</label>
            <input type="text" name="nama" value="{{ request('nama') }}" placeholder="Cari nama..." class="w-full border-gray-300 rounded-xl text-sm focus:ring-green-500 focus:border-green-500 shadow-sm py-2.5">
        </div>
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tanggal</label>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="w-full border-gray-300 rounded-xl text-sm focus:ring-green-500 focus:border-green-500 shadow-sm py-2">
        </div>
        
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Min. Harga Satuan</label>
            <input type="number" name="harga" value="{{ request('harga') }}" placeholder="Contoh: 5000" class="w-full border-gray-300 rounded-xl text-sm focus:ring-green-500 focus:border-green-500 shadow-sm py-2.5">
        </div>
        
        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-green-600 text-white font-bold py-2.5 rounded-xl hover:bg-green-700 transition shadow-md">Terapkan</button>
            <a href="{{ route('admin.penjualan.index') }}" class="px-4 py-2.5 bg-gray-100 text-gray-500 rounded-xl hover:bg-gray-200 transition text-center font-bold text-xs">Reset</a>
        </div>
    </form>
</div>

            <div class="bg-white shadow-xl border border-gray-100 rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-bold text-gray-700 uppercase text-sm tracking-widest">Data Transaksi</h3>
                    <a href="{{ route('admin.penjualan.create') }}" class="px-4 py-2 bg-green-600 text-white text-xs font-bold rounded-lg hover:bg-green-700 transition shadow-sm">+ TAMBAH DATA</a>
                </div>
                
                <div class="p-6 overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-[10px] tracking-widest">
                            <tr>
                                <th class="px-6 py-4 text-center">No</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Nama Barang</th>
                                <th class="px-6 py-4 text-right">Harga</th>
                                <th class="px-6 py-4 text-center">Jml</th>
                                <th class="px-6 py-4 text-right">Total</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($penjualans as $index => $penjualan)
                            <tr class="hover:bg-green-50/30 transition-colors">
                                <td class="px-6 py-4 text-center font-bold text-gray-400">{{ $penjualans->firstItem() + $index }}</td>
                                <td class="px-6 py-4 font-medium">{{ \Carbon\Carbon::parse($penjualan->tanggal)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-gray-900">{{ $penjualan->nama_barang }}</span><br>
                                    <span class="text-[10px] text-gray-400 uppercase">Kasir: {{ $penjualan->user->name ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">Rp {{ number_format($penjualan->harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center font-bold">{{ $penjualan->jumlah }}</td>
                                <td class="px-6 py-4 text-right font-black text-green-700">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-3">
                                        <a href="{{ route('admin.penjualan.edit', $penjualan->id) }}" class="text-yellow-600 hover:text-yellow-800 transition">Edit</a>
                                        <form action="{{ route('admin.penjualan.destroy', $penjualan->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-400 italic">Tidak ada data ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    {{ $penjualans->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>