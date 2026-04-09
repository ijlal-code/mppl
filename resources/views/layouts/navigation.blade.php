<nav x-data="{ open: false }" class="bg-white border-b border-green-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <div class="w-10 h-10 bg-green-600 text-white rounded-xl flex items-center justify-center font-bold text-xl shadow-md">
                        POS
                    </div>
                </div>
                
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(Auth::user()->role === 'kasir')
                        <x-nav-link :href="route('kasir.create')" :active="request()->routeIs('kasir.create')" class="text-green-800 hover:text-green-600 font-bold border-green-500">
                            {{ __('➕ Form Input Kasir') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-green-100 text-sm font-medium rounded-full text-green-800 bg-green-50 hover:bg-green-100 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }} <span class="font-extrabold text-green-600 ml-1">[{{ strtoupper(Auth::user()->role) }}]</span></div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-green-50 hover:text-green-700">Profil Saya</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 hover:bg-red-50">Keluar</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>