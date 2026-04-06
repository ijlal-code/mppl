<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="text-gray-500 font-medium">Edit Barang:</span> 
            <span class="text-emerald-700">{{ $barang->nama_barang }}</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 sm:p-8">
                <form method="POST" action="{{ route('barang.update', $barang->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="kode_barang" value="Kode Barang" class="text-gray-700 font-bold" />
                            <x-text-input id="kode_barang" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg bg-gray-50" type="text" name="kode_barang" :value="old('kode_barang', $barang->kode_barang)" required autofocus readonly title="Kode Barang biasanya tidak diubah" />
                            <x-input-error :messages="$errors->get('kode_barang')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="nama_barang" value="Nama Barang" class="text-gray-700 font-bold" />
                            <x-text-input id="nama_barang" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg" type="text" name="nama_barang" :value="old('nama_barang', $barang->nama_barang)" required />
                            <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="kategori" value="Kategori" class="text-gray-700 font-bold" />
                            <x-text-input id="kategori" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg" type="text" name="kategori" :value="old('kategori', $barang->kategori)" required />
                            <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                        </div>
                        
                        <div>
                            <x-input-label for="satuan" value="Satuan (Misal: Kg, Pcs)" class="text-gray-700 font-bold" />
                            <x-text-input id="satuan" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg" type="text" name="satuan" :value="old('satuan', $barang->satuan)" required />
                            <x-input-error :messages="$errors->get('satuan')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="stok" value="Jumlah Stok" class="text-gray-700 font-bold" />
                            <x-text-input id="stok" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg" type="number" name="stok" :value="old('stok', $barang->stok)" required />
                            <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="harga" value="Harga (Rp)" class="text-gray-700 font-bold" />
                            <x-text-input id="harga" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg" type="number" step="0.01" name="harga" :value="old('harga', $barang->harga)" required />
                            <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 mt-6">
                        <x-input-label for="gambar" value="Ganti Gambar (Opsional)" class="text-gray-700 font-bold mb-2" />
                        
                        <div class="flex items-start gap-6">
                            @if ($barang->gambar)
                                <div class="shrink-0">
                                    <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Saat Ini" class="w-24 h-24 rounded-xl object-cover border-2 border-emerald-100 shadow-sm">
                                </div>
                            @endif
                            
                            <div class="flex-1 w-full">
                                <input id="gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-colors border border-gray-200 rounded-lg" type="file" name="gambar" accept="image/*" />
                                <p class="mt-2 text-xs text-gray-500">Abaikan jika tidak ingin mengubah gambar.</p>
                                <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-100 gap-3">
                        <a href="{{ route('barang.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2 bg-emerald-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all shadow-sm">
                            Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>