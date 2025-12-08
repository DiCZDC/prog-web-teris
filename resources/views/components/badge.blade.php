@props([
    'variant' => 'default',
    'size' => 'md'
])

@php
$variants = [
    'default' => 'bg-gray-500/20 text-gray-200 border-gray-400/30',
    'success' => 'bg-green-500/20 text-green-200 border-green-400/30',
    'danger' => 'bg-red-500/20 text-red-200 border-red-400/30',
    'warning' => 'bg-yellow-500/20 text-yellow-200 border-yellow-400/30',
    'info' => 'bg-blue-500/20 text-blue-200 border-blue-400/30',
    'primary' => 'bg-purple-500/20 text-purple-200 border-purple-400/30',
    'green' => 'bg-green-500/20 text-green-200 border-green-400/30',
    'red' => 'bg-red-500/20 text-red-200 border-red-400/30',
    'blue' => 'bg-blue-500/20 text-blue-200 border-blue-400/30',
    'purple' => 'bg-purple-500/20 text-purple-200 border-purple-400/30',
];

$sizes = [
    'sm' => 'px-2 py-1 text-xs',
    'md' => 'px-3 py-1 text-sm',
    'lg' => 'px-4 py-2 text-base',
];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center justify-center font-bold uppercase tracking-wider border backdrop-blur-sm rounded-full {$variants[$variant]} {$sizes[$size]}"]) }}>
    {{ $slot }}
</span>