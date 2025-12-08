@props([
    'variant' => 'info',
    'dismissible' => false
])

@php
$variants = [
    'success' => [
        'bg' => 'bg-green-500/20',
        'border' => 'border-green-500/50',
        'text' => 'text-green-100',
    ],
    'error' => [
        'bg' => 'bg-red-500/20',
        'border' => 'border-red-500/50',
        'text' => 'text-red-100',
    ],
    'warning' => [
        'bg' => 'bg-yellow-500/20',
        'border' => 'border-yellow-500/50',
        'text' => 'text-yellow-100',
    ],
    'info' => [
        'bg' => 'bg-blue-500/20',
        'border' => 'border-blue-500/50',
        'text' => 'text-blue-100',
    ],
];

$config = $variants[$variant];
@endphp

<div {{ $attributes->merge(['class' => "p-4 rounded-xl border backdrop-blur-sm {$config['bg']} {$config['border']} {$config['text']}"]) }}>
    <div class="flex items-start gap-3">
        <div class="flex-1 font-semibold">
            {{ $slot }}
        </div>
        
        @if($dismissible)
            <button type="button" onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 hover:opacity-70 transition-opacity">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        @endif
    </div>
</div>