<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-extrabold text-green-800">Tambah Data Penjualan (Admin)</h2>
                <a href="{{ route('admin.penjualan.index') }}" class="text-sm font-bold text-gray-500 hover:text-gray-700"> Kembali</a>
            </div>

            <form method="POST" action="{{ route('admin.penjualan.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="nama_barang" :value="__('Nama Barang')" class="font-bold" />
                        <x-text-input id="nama_barang" name="nama_barang" type="text" class="mt-1 block w-full border-green-200 focus:border-green-500 focus:ring-green-500" :value="old('nama_barang')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('nama_barang')" />
                    </div>

                    <div>
                        <x-input-label for="tanggal" :value="__('Tanggal')" class="font-bold" />
                        <x-text-input id="tanggal" name="tanggal" type="date" class="mt-1 block w-full border-green-200 focus:border-green-500 focus:ring-green-500" :value="old('tanggal', date('Y-m-d'))" required />
                        <x-input-error class="mt-2" :messages="$errors->get('tanggal')" />
                    </div>

                    <div>
                        <x-input-label for="harga" :value="__('Harga Satuan')" class="font-bold" />
                        <x-text-input id="harga" name="harga" type="number" class="mt-1 block w-full border-green-200 focus:border-green-500 focus:ring-green-500" :value="old('harga')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('harga')" />
                    </div>

                    <div>
                        <x-input-label for="jumlah" :value="__('Jumlah')" class="font-bold" />
                        <x-text-input id="jumlah" name="jumlah" type="number" class="mt-1 block w-full border-green-200 focus:border-green-500 focus:ring-green-500" :value="old('jumlah')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('jumlah')" />
                    </div>
                </div>

                <div class="p-4 bg-green-50 rounded-xl border border-green-100">
                    <x-input-label for="foto_barang" :value="__('Foto Produk (Opsional)')" class="font-bold text-green-800" />
                    <input id="foto_barang" name="foto_barang" type="file" class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-green-700 file:text-white hover:file:bg-green-800" accept="image/*" />
                    <x-input-error class="mt-2" :messages="$errors->get('foto_barang')" />
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <x-primary-button class="bg-green-700 hover:bg-green-800 focus:bg-green-800 active:bg-green-900 px-8 py-3">
                        {{ __('Tambah Data') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>