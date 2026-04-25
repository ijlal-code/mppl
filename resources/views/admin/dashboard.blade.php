<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin - Kelola Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Daftar Pesanan Masuk</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-4 border text-left text-sm font-semibold text-gray-600">ID</th>
                                <th class="py-2 px-4 border text-left text-sm font-semibold text-gray-600">Pemesan</th>
                                <th class="py-2 px-4 border text-left text-sm font-semibold text-gray-600">No. WhatsApp</th>
                                <th class="py-2 px-4 border text-left text-sm font-semibold text-gray-600">Menu Dipesan</th>
                                <th class="py-2 px-4 border text-left text-sm font-semibold text-gray-600">Jumlah</th>
                                <th class="py-2 px-4 border text-left text-sm font-semibold text-gray-600">Total Harga</th>
                                <th class="py-2 px-4 border text-left text-sm font-semibold text-gray-600">Status</th>
                                <th class="py-2 px-4 border text-center text-sm font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesanans as $pesanan)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-2 px-4 border text-sm text-gray-700">#{{ $pesanan->id }}</td>
                                    <td class="py-2 px-4 border text-sm text-gray-700">{{ $pesanan->nama_pemesan }}</td>
                                    <td class="py-2 px-4 border text-sm text-gray-700">{{ $pesanan->no_telp }}</td>
                                    <td class="py-2 px-4 border text-sm text-gray-700">{{ $pesanan->produk->nama_makanan }}</td>
                                    <td class="py-2 px-4 border text-sm text-gray-700 text-center">{{ $pesanan->jumlah }}</td>
                                    <td class="py-2 px-4 border text-sm font-bold text-green-600">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                    <td class="py-2 px-4 border text-sm text-center">
                                        @if($pesanan->status == 'pending')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-bold">Menunggu</span>
                                        @else
                                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-bold">Diterima</span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border text-center">
                                        @if($pesanan->status == 'pending')
                                            <form action="{{ route('admin.terima', $pesanan->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-3 rounded">
                                                    Terima & Kabari
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 text-xs italic">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-4 text-center text-gray-500">Belum ada pesanan masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>