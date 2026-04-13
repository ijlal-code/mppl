<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Pesanan Masuk</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border p-2">Nama Pemesan</th>
                            <th class="border p-2">Menu</th>
                            <th class="border p-2">No WA</th>
                            <th class="border p-2">Jumlah</th>
                            <th class="border p-2">Total</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanans as $p)
                        <tr>
                            <td class="border p-2">{{ $p->nama_pemesan }}</td>
                            <td class="border p-2">{{ $p->produk->nama_makanan }}</td>
                            <td class="border p-2">{{ $p->no_telp }}</td>
                            <td class="border p-2">{{ $p->jumlah }}</td>
                            <td class="border p-2">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                            <td class="border p-2">
                                <span class="px-2 py-1 rounded text-white text-xs {{ $p->status == 'pending' ? 'bg-yellow-500' : 'bg-green-500' }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="border p-2">
                                @if($p->status == 'pending')
                                <form action="{{ route('admin.pesanan.terima', $p->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">Terima & Kabari via WA</button>
                                </form>
                                @else
                                <span class="text-gray-500 text-sm">Sudah Diterima</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>