@props(['title', 'value', 'color', 'icon'])

@php
    $colors = [
        'blue' => 'border-blue-500 text-blue-800 bg-blue-100',
        'green' => 'border-green-500 text-green-800 bg-green-100',
        'yellow' => 'border-yellow-500 text-yellow-800 bg-yellow-100',
        'pink' => 'border-pink-500 text-pink-800 bg-pink-100',
    ];
@endphp

<div class="bg-white p-5 rounded-xl shadow-md border-l-4 {{ $colors[$color] ?? 'border-gray-300' }}">
    <div class="flex items-center space-x-4">
        <div class="p-3 rounded-full {{ $colors[$color] ?? '' }}">
            <span class="text-2xl">{{ $icon }}</span>
        </div>
        <div>
            <p class="text-sm text-gray-600">{{ $title }}</p>
            <p class="text-xl font-bold text-gray-800">{{ $value }}</p>
        </div>
    </div>
</div>
