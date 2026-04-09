<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white overflow-hidden shadow-xl border-t-4 border-green-600 sm:rounded-2xl p-8 mt-6">
        
        <div class="mb-6 border-b border-green-100 pb-4 flex items-center">
            <div class="bg-green-100 p-3 rounded-full mr-4 text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <h2 class="text-2xl font-extrabold text-green-800">Kasir: Input Barang Manual</h2>
        </div>
        
        @if(session('success'))
            <div class="bg-green-50 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-6 font-semibold shadow-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('kasir.store') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-green-900 font-bold mb-2">Nama Barang</label>
                <input type="text" name="nama_barang" class="w-full border-gray-300 focus:border-green-600 focus:ring-green-600 rounded-lg shadow-sm bg-gray-50" placeholder="Ketik nama barang secara manual..." required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-green-900 font-bold mb-2">Harga Satuan (Rp)</label>
                    <input type="number" name="harga" min="0" class="w-full border-gray-300 focus:border-green-600 focus:ring-green-600 rounded-lg shadow-sm bg-gray-50" placeholder="Contoh: 15000" required>
                </div>

                <div>
                    <label class="block text-green-900 font-bold mb-2">Jumlah Barang</label>
                    <input type="number" name="jumlah" min="1" class="w-full border-gray-300 focus:border-green-600 focus:ring-green-600 rounded-lg shadow-sm bg-gray-50" placeholder="Contoh: 3" required>
                </div>
            </div>

            <div>
                <label class="block text-green-900 font-bold mb-2">Tanggal Transaksi</label>
                <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full border-gray-300 focus:border-green-600 focus:ring-green-600 rounded-lg shadow-sm bg-gray-50" required>
            </div>

            <button type="submit" class="w-full mt-4 bg-green-600 hover:bg-green-700 text-white font-extrabold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                💾 SIMPAN TRANSAKSI
            </button>
        </form>
    </div>
</x-app-layout>