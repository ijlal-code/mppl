<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-green-900 overflow-hidden shadow-2xl sm:rounded-2xl p-6 border border-green-700">
            
            <!-- Header -->
            <div class="flex items-center mb-6">
                <div class="p-3 bg-white rounded-lg mr-4 shadow">
                    <svg class="w-6 h-6 text-green-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-extrabold text-white">Transaksi Penjualan Baru</h2>
            </div>

            <!-- Alert -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-white border-l-4 border-green-600 text-green-800 font-medium rounded-r-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('kasir.store') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Nama Barang -->
                    <div>
                        <x-input-label for="nama_barang" :value="__('Nama Barang')" class="font-bold text-white" />
                        <x-text-input id="nama_barang" name="nama_barang" type="text"
                            class="mt-1 block w-full bg-white text-gray-800 border-green-700 focus:border-green-500 focus:ring-green-500"
                            :value="old('nama_barang')" required placeholder="Contoh: Kopi Susu" />
                        <x-input-error class="mt-2 text-red-300" :messages="$errors->get('nama_barang')" />
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <x-input-label for="tanggal" :value="__('Tanggal Transaksi')" class="font-bold text-white" />
                        <x-text-input id="tanggal" name="tanggal" type="date"
                            class="mt-1 block w-full bg-white text-gray-800 border-green-700"
                            :value="old('tanggal', date('Y-m-d'))" required />
                        <x-input-error class="mt-2 text-red-300" :messages="$errors->get('tanggal')" />
                    </div>

                    <!-- Harga -->
                    <div>
                        <x-input-label for="harga" :value="__('Harga Satuan (Rp)')" class="font-bold text-white" />
                        <x-text-input id="harga" name="harga" type="number"
                            class="mt-1 block w-full bg-white text-gray-800 border-green-700"
                            :value="old('harga')" required min="0" placeholder="0" />
                        <x-input-error class="mt-2 text-red-300" :messages="$errors->get('harga')" />
                    </div>

                    <!-- Jumlah -->
                    <div>
                        <x-input-label for="jumlah" :value="__('Jumlah Beli')" class="font-bold text-white" />
                        <x-text-input id="jumlah" name="jumlah" type="number"
                            class="mt-1 block w-full bg-white text-gray-800 border-green-700"
                            :value="old('jumlah')" required min="1" placeholder="1" />
                        <x-input-error class="mt-2 text-red-300" :messages="$errors->get('jumlah')" />
                    </div>
                </div>

                <!-- Upload -->
                <div class="bg-green-800 p-4 rounded-xl border border-green-600">
                    <x-input-label for="foto_barang" :value="__('Foto Barang (Opsional)')" class="font-bold text-white" />
                    <input id="foto_barang" name="foto_barang" type="file"
                        class="mt-2 block w-full text-sm text-white 
                        file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 
                        file:text-sm file:font-bold file:bg-white file:text-green-800 hover:file:bg-gray-200 transition-all"
                        accept="image/*" />
                    <p class="mt-2 text-xs text-gray-200 italic">*Format: JPG, PNG, JPEG. Maks: 2MB</p>
                    <x-input-error class="mt-2 text-red-300" :messages="$errors->get('foto_barang')" />
                </div>

                <!-- Button -->
                <div class="flex items-center justify-end pt-4">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-white border border-transparent rounded-xl font-bold text-sm text-green-900 uppercase tracking-widest hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-white transition shadow-lg">
                        
                        <svg class="w-4 h-4 mr-2 text-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                        </svg>

                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>