<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="text-gray-500 font-medium">Edit Barang:</span> 
            <span class="text-emerald-700 font-extrabold">{{ $barang->nama_barang }}</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 sm:p-8">
                <form method="POST" action="{{ route('barang.update', $barang->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="kode_barang" value="Kode Barang" class="text-gray-700 font-bold" />
                            <x-text-input id="kode_barang" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg bg-gray-100 text-gray-600 cursor-not-allowed shadow-inner" type="text" name="kode_barang" :value="old('kode_barang', $barang->kode_barang)" required autofocus readonly title="Kode Barang biasanya tidak diubah" />
                            <x-input-error :messages="$errors->get('kode_barang')" class="mt-2 text-red-600 font-medium" />
                        </div>

                        <div>
                            <x-input-label for="nama_barang" value="Nama Barang" class="text-gray-700 font-bold" />
                            <x-text-input id="nama_barang" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" type="text" name="nama_barang" :value="old('nama_barang', $barang->nama_barang)" required />
                            <x-input-error :messages="$errors->get('nama_barang')" class="mt-2 text-red-600 font-medium" />
                        </div>

                        <div>
                            <x-input-label for="kategori" value="Kategori" class="text-gray-700 font-bold" />
                            <x-text-input id="kategori" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" type="text" name="kategori" :value="old('kategori', $barang->kategori)" required />
                            <x-input-error :messages="$errors->get('kategori')" class="mt-2 text-red-600 font-medium" />
                        </div>
                        
                        <div>
                            <x-input-label for="satuan" value="Satuan (Misal: Kg, Pcs)" class="text-gray-700 font-bold" />
                            <x-text-input id="satuan" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" type="text" name="satuan" :value="old('satuan', $barang->satuan)" required />
                            <x-input-error :messages="$errors->get('satuan')" class="mt-2 text-red-600 font-medium" />
                        </div>

                        <div>
                            <x-input-label for="stok" value="Jumlah Stok" class="text-gray-700 font-bold" />
                            <x-text-input id="stok" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" type="number" name="stok" :value="old('stok', $barang->stok)" required />
                            <x-input-error :messages="$errors->get('stok')" class="mt-2 text-red-600 font-medium" />
                        </div>

                        <div>
                            <x-input-label for="harga" value="Harga (Rp)" class="text-gray-700 font-bold" />
                            <x-text-input id="harga" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" type="number" step="0.01" name="harga" :value="old('harga', $barang->harga)" required />
                            <x-input-error :messages="$errors->get('harga')" class="mt-2 text-red-600 font-medium" />
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 mt-6">
                        <x-input-label for="gambar" value="Ganti Gambar (Opsional)" class="text-gray-700 font-bold mb-3" />
                        
                        <div class="flex items-start gap-6 bg-gray-50 p-4 rounded-xl border border-gray-100">
                            @if ($barang->gambar)
                                <div class="shrink-0 bg-white p-2 rounded-lg shadow-sm border border-gray-200">
                                    <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Saat Ini" class="w-24 h-24 rounded-md object-cover">
                                </div>
                            @endif
                            
                            <div class="flex-1 w-full self-center">
                                <input id="gambar" class="block w-full text-sm text-gray-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200 transition-colors border border-gray-300 rounded-lg bg-white cursor-pointer" type="file" name="gambar" accept="image/*" />
                                <p class="mt-2 text-xs font-semibold text-gray-500">Abaikan jika tidak ingin mengubah gambar.</p>
                                <x-input-error :messages="$errors->get('gambar')" class="mt-2 text-red-600 font-medium" />
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-100 gap-4">
                        <a href="{{ route('barang.index') }}" class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-300 rounded-lg font-bold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-emerald-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest shadow-md hover:bg-emerald-700 focus:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all">
                            Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>