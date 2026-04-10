<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl text-emerald-800 leading-tight">
                {{ __('My Profile') }}
            </h2>

            <div class="flex items-center">
                {{-- Gunakan strtolower agar tidak sensitif huruf besar/kecil (Admin/admin tetap terbaca) --}}
                @if(strtolower(auth()->user()->role) === 'admin')
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-bold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all">
                        &larr; {{ __('Kembali ke Dashboard') }}
                    </a>
                @elseif(strtolower(auth()->user()->role) === 'kasir')
                    <a href="{{ route('kasir.create') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-bold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all">
                        &larr; {{ __('Kembali ke Kasir') }}
                    </a>
                @else
                    {{-- Default jika tidak punya role --}}
                    <a href="{{ url('/') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-bold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all">
                        &larr; {{ __('Kembali') }}
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="p-6 sm:p-8 bg-white shadow-sm border border-gray-100 rounded-xl">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-xl font-extrabold text-gray-900">
                                {{ __('Profile Photo') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 font-medium">
                                {{ __("Update your account's profile photo.") }}
                            </p>
                        </header>
                        
                        <form method="post" action="{{ route('profile.update.photo') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            
                            <div class="flex items-start gap-6 bg-gray-50 p-4 rounded-xl border border-gray-100">
                                @if (auth()->user()->photo_profile)
                                    <div class="shrink-0 bg-white p-2 rounded-lg shadow-sm border border-gray-200">
                                        <img src="{{ asset('storage/' . auth()->user()->photo_profile) }}" alt="Foto Profil" class="w-20 h-20 rounded-md object-cover">
                                    </div>
                                @else
                                    <div class="shrink-0 w-20 h-20 rounded-lg bg-emerald-100 flex items-center justify-center border border-emerald-200 shadow-sm">
                                        <span class="text-3xl font-extrabold text-emerald-600">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                @endif

                                <div class="flex-1 w-full self-center">
                                    <x-input-label for="photo_profile" :value="__('New Photo')" class="mb-2" />
                                    <input id="photo_profile" name="photo_profile" type="file" class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200 transition-colors border border-gray-300 rounded-lg bg-white cursor-pointer" />
                                    <x-input-error class="mt-2 text-red-600 font-bold" :messages="$errors->get('photo_profile')" />
                                </div>
                            </div>

                            <div class="flex items-center gap-4 pt-4">
                                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-emerald-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest shadow-md hover:bg-emerald-700 focus:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all">
                                    {{ __('Save Photo') }}
                                </button>

                                @if (session('status') === 'photo-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-emerald-600 font-bold flex items-center"
                                    >
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        {{ __('Saved.') }}
                                    </p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white shadow-sm border border-gray-100 rounded-xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white shadow-sm border border-gray-100 rounded-xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-red-50/30 shadow-sm border border-red-100 rounded-xl">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>