<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard Overview') }}
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 border-l-4 border-l-emerald-500 hover:shadow-lg transition-shadow">
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Barang</h3>
            <p class="mt-2 text-4xl font-extrabold text-emerald-600">125</p>
        </div>
        <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 border-l-4 border-l-teal-500 hover:shadow-lg transition-shadow">
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Kategori</h3>
            <p class="mt-2 text-4xl font-extrabold text-teal-600">12</p>
        </div>
        <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 border-l-4 border-l-yellow-400 hover:shadow-lg transition-shadow">
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Stok Menipis</h3>
            <p class="mt-2 text-4xl font-extrabold text-yellow-500">5</p>
        </div>
        <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 border-l-4 border-l-green-500 hover:shadow-lg transition-shadow">
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Barang Masuk Hari Ini</h3>
            <p class="mt-2 text-4xl font-extrabold text-green-600">20</p>
        </div>
    </div>

    <div class="bg-white shadow-sm border border-gray-100 rounded-xl overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white">
            <h3 class="text-xl font-bold text-gray-800">Update Data Terakhir</h3>
            <a href="{{ route('barang.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-lg font-semibold text-sm text-white shadow-sm hover:bg-emerald-700 active:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Barang
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-emerald-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-extrabold text-emerald-800 uppercase tracking-wider">No.</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-extrabold text-emerald-800 uppercase tracking-wider">Gambar</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-extrabold text-emerald-800 uppercase tracking-wider">Kode</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-extrabold text-emerald-800 uppercase tracking-wider">Nama Barang</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-extrabold text-emerald-800 uppercase tracking-wider">Kategori</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-extrabold text-emerald-800 uppercase tracking-wider">Stok</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-extrabold text-emerald-800 uppercase tracking-wider">Harga</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-extrabold text-emerald-800 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($barangs ?? [] as $index => $barang)
                        <tr class="hover:bg-emerald-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($barang->gambar)
                                    <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar" class="h-12 w-12 object-cover rounded-lg shadow-sm border border-gray-200">
                                @else
                                    <div class="h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-xs text-gray-400 font-medium">N/A</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-emerald-700">{{ $barang->kode_barang }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $barang->nama_barang }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <span class="px-2.5 py-1 bg-gray-100 border border-gray-200 text-gray-700 rounded-full text-xs font-bold">{{ $barang->kategori }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="font-extrabold {{ $barang->stok <= 5 ? 'text-red-600' : 'text-gray-900' }}">{{ $barang->stok }}</span> 
                                <span class="text-gray-500 font-medium">{{ $barang->satuan }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-3">
                                    <a href="{{ route('barang.edit', $barang->id) }}" class="text-emerald-600 hover:text-emerald-800 font-bold transition-colors">Edit</a>
                                    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-bold transition-colors" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 whitespace-nowrap text-sm text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    <p class="font-medium text-gray-500">Belum ada data barang. Silakan tambah barang baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>