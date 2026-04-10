<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-extrabold text-amber-600">Edit Data Penjualan</h2>
                <a href="{{ route('admin.penjualan.index') }}" class="text-sm font-bold text-gray-500 hover:text-gray-700">Batal</a>
            </div>

            <form method="POST" action="{{ route('admin.penjualan.update', $penjualan->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="nama_barang" :value="__('Nama Barang')" class="font-bold" />
                        <x-text-input id="nama_barang" name="nama_barang" type="text" class="mt-1 block w-full" :value="old('nama_barang', $penjualan->nama_barang)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('nama_barang')" />
                    </div>

                    <div>
                        <x-input-label for="tanggal" :value="__('Tanggal')" class="font-bold" />
                        <x-text-input id="tanggal" name="tanggal" type="date" class="mt-1 block w-full" :value="old('tanggal', \Carbon\Carbon::parse($penjualan->tanggal)->format('Y-m-d'))" required />
                        <x-input-error class="mt-2" :messages="$errors->get('tanggal')" />
                    </div>

                    <div>
                        <x-input-label for="harga" :value="__('Harga Satuan')" class="font-bold" />
                        <x-text-input id="harga" name="harga" type="number" class="mt-1 block w-full" :value="old('harga', $penjualan->harga)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('harga')" />
                    </div>

                    <div>
                        <x-input-label for="jumlah" :value="__('Jumlah')" class="font-bold" />
                        <x-text-input id="jumlah" name="jumlah" type="number" class="mt-1 block w-full" :value="old('jumlah', $penjualan->jumlah)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('jumlah')" />
                    </div>
                </div>

                <div class="p-4 bg-amber-50 rounded-xl border border-amber-100">
                    <x-input-label for="foto_barang" :value="__('Ganti Foto (Opsional)')" class="font-bold text-amber-800" />
                    
                    @if($penjualan->foto_barang)
                        <div class="mt-2 mb-4">
                            <p class="text-xs text-amber-700 mb-2">Foto Saat Ini:</p>
                            <img src="{{ asset('storage/' . $penjualan->foto_barang) }}" class="h-32 w-32 object-cover rounded-lg border-2 border-amber-200 shadow-sm">
                        </div>
                    @endif

                    <input id="foto_barang" name="foto_barang" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-amber-600 file:text-white hover:file:bg-amber-700" accept="image/*" />
                    <x-input-error class="mt-2" :messages="$errors->get('foto_barang')" />
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-3 px-8 rounded-xl shadow-md transition-all uppercase text-xs tracking-widest">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>