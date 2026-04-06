@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 bg-white text-black font-semibold focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm transition-colors duration-200 placeholder-gray-500']) }}>