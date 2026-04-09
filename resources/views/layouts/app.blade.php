<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Sistem POS Hijau') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50">
        <div class="flex h-screen overflow-hidden">
            
            @if(Auth::user()->role === 'admin')
            <aside class="w-64 bg-green-800 text-white flex flex-col shadow-xl flex-shrink-0">
                <div class="h-16 flex items-center justify-center border-b border-green-700 font-extrabold text-2xl tracking-widest">
                    POS ADMIN
                </div>
                <nav class="flex-1 px-4 py-6 space-y-3 overflow-y-auto">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-green-600 border-l-4 border-white' : 'hover:bg-green-700 text-green-100' }}">
                        <span class="mr-3 text-lg">📊</span> Dashboard
                    </a>
                    <a href="{{ route('admin.penjualan.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.penjualan.*') ? 'bg-green-600 border-l-4 border-white' : 'hover:bg-green-700 text-green-100' }}">
                        <span class="mr-3 text-lg">📁</span> Data Penjualan
                    </a>
                </nav>
            </aside>
            @endif

            <div class="flex-1 flex flex-col overflow-hidden">
                @include('layouts.navigation')

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 sm:p-6 lg:p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>