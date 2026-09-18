@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge([
    'class' => 'border-gray-300 bg-white/80 text-gray-700 focus:border-teal-700 focus:ring-teal-700 rounded-md shadow-sm'
]) }}>

