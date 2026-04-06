<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pergudangan') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100">
        
        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100 dark:bg-gray-900 overflow-hidden">
            
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-900/80 z-20 lg:hidden"
                 @click="sidebarOpen = false" 
                 style="display: none;"
                 aria-hidden="true">
            </div>

            <aside 
                class="fixed inset-y-0 left-0 z-30 w-64 h-screen bg-gray-800 text-white transition-transform duration-300 transform lg:static lg:translate-x-0 flex flex-col shadow-lg shrink-0"
                :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
            >
                <div class="flex items-center justify-center py-4 px-6 border-b border-gray-700 h-16 shrink-0">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-9 w-auto fill-current text-white" />
                        <span class="text-xl font-semibold text-white truncate">Pergudangan</span>
                    </a>
                </div>

                <div class="py-4 px-6 border-b border-gray-700 shrink-0">
                    <div class="flex items-center">
                        <img class="h-10 w-10 rounded-full object-cover border-2 border-gray-600" src="{{ auth()->user()->photo_profile ? asset('storage/' . auth()->user()->photo_profile) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&color=7F9CF5&background=EBF4FF' }}" alt="User photo">
                        <div class="ml-3 overflow-hidden">
                            <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400 truncate">Administrator</p>
                        </div>
                    </div>
                </div>

                <nav class="flex-1 overflow-y-auto mt-4 pb-4">
                    <span class="text-xs font-semibold text-gray-400 uppercase px-6">Master</span>
                    
                    <a href="{{ route('dashboard') }}" class="flex items-center mt-2 py-2 px-6 {{ request()->routeIs('dashboard') ? 'bg-gray-900 text-white border-l-4 border-indigo-500' : 'text-gray-300 hover:bg-gray-700 hover:text-white border-l-4 border-transparent transition-colors' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span class="mx-3 truncate">Dashboard</span>
                    </a>

                    <a href="#" class="flex items-center mt-2 py-2 px-6 text-gray-300 hover:bg-gray-700 hover:text-white border-l-4 border-transparent transition-colors">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z"></path></svg>
                        <span class="mx-3 truncate">Kategori</span>
                    </a>

                    <a href="#" class="flex items-center mt-2 py-2 px-6 text-gray-300 hover:bg-gray-700 hover:text-white border-l-4 border-transparent transition-colors">
                         <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                        <span class="mx-3 truncate">Satuan</span>
                    </a>

                    <a href="{{ route('barang.index') }}" class="flex items-center mt-2 py-2 px-6 {{ request()->routeIs('barang.*') ? 'bg-gray-900 text-white border-l-4 border-indigo-500' : 'text-gray-300 hover:bg-gray-700 hover:text-white border-l-4 border-transparent transition-colors' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                        <span class="mx-3 truncate">Barang</span>
                    </a>
                </nav>                
            </aside>

            <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
                
                <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-100 dark:border-gray-700 w-full z-10 shrink-0">
                    @include('layouts.navigation')
                </header>

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 dark:bg-gray-900 w-full">
                    
                    @isset($header)
                        <div class="bg-white dark:bg-gray-800 shadow-sm mb-4">
                            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 font-semibold text-xl text-gray-800 dark:text-gray-200">
                                {{ $header }}
                            </div>
                        </div>
                    @endisset

                    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto w-full">
                        {{ $slot }}
                    </div>
                </main>

            </div>
        </div>
    </body>
</html>