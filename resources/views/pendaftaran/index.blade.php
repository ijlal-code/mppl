<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Peserta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex justify-between items-center">
                        <h3 class="text-lg font-bold">Data Pendaftaran</h3>
                        <a href="{{ route('pendaftaran.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                            + Tambah Peserta
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-200 px-4 py-2">No</th>
                                    <th class="border border-gray-200 px-4 py-2">Nama Lengkap</th>
                                    <th class="border border-gray-200 px-4 py-2">Email</th>
                                    <th class="border border-gray-200 px-4 py-2">Asal Instansi</th>
                                    <th class="border border-gray-200 px-4 py-2 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($peserta as $index => $p)
                                    <tr>
                                        <td class="border border-gray-200 px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="border border-gray-200 px-4 py-2">{{ $p->nama }}</td>
                                        <td class="border border-gray-200 px-4 py-2">{{ $p->email }}</td>
                                        <td class="border border-gray-200 px-4 py-2">{{ $p->instansi }}</td>
                                        <td class="border border-gray-200 px-4 py-2 text-center">
                                            <a href="{{ route('pendaftaran.edit', $p->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                                            <form action="{{ route('pendaftaran.destroy', $p->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="border border-gray-200 px-4 py-2 text-center text-gray-500">
                                            Belum ada data pendaftaran.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>