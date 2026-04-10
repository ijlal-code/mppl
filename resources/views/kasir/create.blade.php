<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-6 border border-gray-100">
            <div class="flex items-center mb-6">
                <div class="p-3 bg-emerald-100 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800">Transaksi Penjualan Baru</h2>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 font-medium rounded-r-lg">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('kasir.store') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="nama_barang" :value="__('Nama Barang')" class="font-bold" />
                        <x-text-input id="nama_barang" name="nama_barang" type="text" class="mt-1 block w-full" :value="old('nama_barang')" required placeholder="Contoh: Kopi Susu" />
                        <x-input-error class="mt-2" :messages="$errors->get('nama_barang')" />
                    </div>

                    <div>
                        <x-input-label for="tanggal" :value="__('Tanggal Transaksi')" class="font-bold" />
                        <x-text-input id="tanggal" name="tanggal" type="date" class="mt-1 block w-full" :value="old('tanggal', date('Y-m-d'))" required />
                        <x-input-error class="mt-2" :messages="$errors->get('tanggal')" />
                    </div>

                    <div>
                        <x-input-label for="harga" :value="__('Harga Satuan (Rp)')" class="font-bold" />
                        <x-text-input id="harga" name="harga" type="number" class="mt-1 block w-full" :value="old('harga')" required min="0" placeholder="0" />
                        <x-input-error class="mt-2" :messages="$errors->get('harga')" />
                    </div>

                    <div>
                        <x-input-label for="jumlah" :value="__('Jumlah Beli')" class="font-bold" />
                        <x-text-input id="jumlah" name="jumlah" type="number" class="mt-1 block w-full" :value="old('jumlah')" required min="1" placeholder="1" />
                        <x-input-error class="mt-2" :messages="$errors->get('jumlah')" />
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl border border-dashed border-gray-300">
                    <x-input-label for="foto_barang" :value="__('Foto Barang (Opsional)')" class="font-bold text-gray-700" />
                    <input id="foto_barang" name="foto_barang" type="file" class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 transition-all" accept="image/*" />
                    <p class="mt-2 text-xs text-gray-500 italic">*Format: JPG, PNG, JPEG. Maks: 2MB</p>
                    <x-input-error class="mt-2" :messages="$errors->get('foto_barang')" />
                </div>

                <div class="flex items-center justify-end pt-4">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-emerald-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>