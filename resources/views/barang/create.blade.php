<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Barang Baru') }}
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 sm:p-8">
                <form method="POST" action="{{ route('barang.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="kode_barang" value="Kode Barang" class="text-gray-700 font-bold" />
                            <x-text-input id="kode_barang" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" type="text" name="kode_barang" :value="old('kode_barang')" required autofocus placeholder="Contoh: BRG-001" />
                            <x-input-error :messages="$errors->get('kode_barang')" class="mt-2 text-red-600 font-medium" />
                        </div>

                        <div>
                            <x-input-label for="nama_barang" value="Nama Barang" class="text-gray-700 font-bold" />
                            <x-text-input id="nama_barang" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" type="text" name="nama_barang" :value="old('nama_barang')" required placeholder="Nama lengkap barang" />
                            <x-input-error :messages="$errors->get('nama_barang')" class="mt-2 text-red-600 font-medium" />
                        </div>

                        <div>
                            <x-input-label for="kategori" value="Kategori" class="text-gray-700 font-bold" />
                            <x-text-input id="kategori" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" type="text" name="kategori" :value="old('kategori')" required />
                            <x-input-error :messages="$errors->get('kategori')" class="mt-2 text-red-600 font-medium" />
                        </div>

                        <div>
                            <x-input-label for="satuan" value="Satuan (Misal: Kg, Pcs, Box)" class="text-gray-700 font-bold" />
                            <x-text-input id="satuan" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" type="text" name="satuan" :value="old('satuan')" required />
                            <x-input-error :messages="$errors->get('satuan')" class="mt-2 text-red-600 font-medium" />
                        </div>

                        <div>
                            <x-input-label for="stok" value="Jumlah Stok" class="text-gray-700 font-bold" />
                            <x-text-input id="stok" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" type="number" name="stok" :value="old('stok')" required />
                            <x-input-error :messages="$errors->get('stok')" class="mt-2 text-red-600 font-medium" />
                        </div>

                         <div>
                            <x-input-label for="harga" value="Harga (Rp)" class="text-gray-700 font-bold" />
                            <x-text-input id="harga" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" type="number" step="0.01" name="harga" :value="old('harga')" required />
                            <x-input-error :messages="$errors->get('harga')" class="mt-2 text-red-600 font-medium" />
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <x-input-label for="gambar" value="Upload Gambar (Opsional)" class="text-gray-700 font-bold" />
                        <div class="mt-2 flex items-center">
                            <input id="gambar" class="block w-full text-sm text-gray-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-colors border border-gray-200 rounded-lg cursor-pointer bg-gray-50" type="file" name="gambar" accept="image/*" />
                        </div>
                        <p class="mt-1 text-xs text-gray-500 font-medium">Format: JPG, PNG, JPEG.</p>
                        <x-input-error :messages="$errors->get('gambar')" class="mt-2 text-red-600 font-medium" />
                    </div>

                    <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-100 gap-4">
                        <a href="{{ route('barang.index') }}" class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-300 rounded-lg font-bold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-emerald-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest shadow-md hover:bg-emerald-700 focus:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>