<x-app-layout>
    <x-slot name="header">
        {{ __('Manajemen Data Barang') }}
    </x-slot>

    <div class="bg-white shadow-sm border border-gray-100 rounded-xl overflow-hidden">
        <div class="p-6 sm:p-8">

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <h3 class="text-2xl font-extrabold text-gray-800">Daftar Inventaris</h3>
                <a href="{{ route('barang.create') }}" class="inline-flex items-center px-4 py-2.5 bg-emerald-600 border border-transparent rounded-lg font-bold text-sm text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Tambah Barang
                </a>
            </div>

            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-lg mb-6 flex items-center" role="alert">
                    <svg class="w-5 h-5 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="block sm:inline font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="overflow-x-auto relative sm:rounded-lg border border-gray-200">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-emerald-800 uppercase bg-emerald-50 font-extrabold border-b border-gray-200">
                        <tr>
                            <th scope="col" class="py-4 px-6 tracking-wider">No.</th>
                            <th scope="col" class="py-4 px-6 tracking-wider">Gambar</th>
                            <th scope="col" class="py-4 px-6 tracking-wider">Kode</th>
                            <th scope="col" class="py-4 px-6 tracking-wider">Nama Barang</th>
                            <th scope="col" class="py-4 px-6 tracking-wider">Kategori</th>
                            <th scope="col" class="py-4 px-6 tracking-wider">Satuan</th>
                            <th scope="col" class="py-4 px-6 tracking-wider">Stok</th>
                            <th scope="col" class="py-4 px-6 tracking-wider">Harga</th>
                            <th scope="col" class="py-4 px-6 text-center tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($barangs ?? [] as $index => $barang)
                        <tr class="hover:bg-emerald-50/50 transition-colors">
                            <td class="py-4 px-6 font-semibold text-gray-500">{{ (isset($barangs) && method_exists($barangs, 'firstItem')) ? $barangs->firstItem() + $index : $index + 1 }}</td>
                            <td class="py-4 px-6">
                                @if ($barang->gambar)
                                    <img class="w-12 h-12 rounded-lg object-cover shadow-sm border border-gray-200" src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama_barang }}">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center text-xs text-gray-400 font-bold">N/A</div>
                                @endif
                            </td>
                            <td class="py-4 px-6 font-extrabold text-emerald-700">{{ $barang->kode_barang }}</td>
                            <td class="py-4 px-6 font-bold text-gray-900">{{ $barang->nama_barang }}</td>
                            <td class="py-4 px-6">
                                <span class="bg-gray-100 border border-gray-200 text-gray-700 px-3 py-1.5 rounded-full text-xs font-bold">{{ $barang->kategori }}</span>
                            </td>
                            
                            <td class="py-4 px-6">
                                <span class="text-gray-600 font-semibold">{{ $barang->satuan }}</span>
                            </td>
                            
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-gray-900 text-base">{{ $barang->stok }}</span> 
                            </td>
                            
                            <td class="py-4 px-6 font-bold text-gray-900">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                            <td class="py-4 px-6">
                                <div class="flex justify-center items-center space-x-2">
                                    <a href="{{ route('barang.edit', $barang->id) }}" class="p-2 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-md hover:bg-emerald-600 hover:text-white transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z"></path></svg>
                                    </a>
                                    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 border border-red-100 text-red-600 rounded-md hover:bg-red-500 hover:text-white transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="py-12 px-6 text-center text-gray-500 font-medium">
                                Data barang belum tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if(isset($barangs) && method_exists($barangs, 'links'))
            <div class="mt-6">
                {{ $barangs->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>