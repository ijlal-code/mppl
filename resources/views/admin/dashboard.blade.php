<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex gap-4">
                <a href="{{ route('admin.produk.index') }}" class="bg-blue-500 text-white p-4 rounded shadow">Kelola Makanan</a>
                <a href="{{ route('admin.pesanan.index') }}" class="bg-green-500 text-white p-4 rounded shadow">Kelola Pesanan Masuk</a>
            </div>
        </div>
    </div>
</x-app-layout>