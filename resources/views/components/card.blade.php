@props([
    'title' => '',
    'variant' => 'default',
    'padding' => 'normal'
])

@php
$variants = [
    'default' => 'bg-white/10 backdrop-blur-md border-white/20',
    'glass' => 'bg-white/5 backdrop-blur-xl border-white/10',
    'solid' => 'bg-purple-800/50 border-purple-600/30',
    'dark' => 'bg-gray-900/50 border-gray-700/30',
];

$paddings = [
    'none' => '',
    'small' => 'p-4',
    'normal' => 'p-6',
    'large' => 'p-8',
];
@endphp

<div {{ $attributes->merge(['class' => "rounded-2xl border shadow-xl {$variants[$variant]} {$paddings[$padding]} transition-all duration-300"]) }}>
    @if($title)
        <div class="mb-4 pb-4 border-b border-white/10">
            <h3 class="text-xl font-bold text-white">{{ $title }}</h3>
        </div>
    @endif
    
    {{ $slot }}
</div>