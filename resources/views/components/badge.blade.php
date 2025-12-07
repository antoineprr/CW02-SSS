@props(['href', 'type' => 'category', 'size' => 'small'])

@php
    $colors = [
        'category' => ['bg' => 'bg-purple-600', 'hover' => 'hover:bg-purple-700'],
        'team' => ['bg' => 'bg-teal-600', 'hover' => 'hover:bg-teal-700'],
        'player' => ['bg' => 'bg-amber-600', 'hover' => 'hover:bg-amber-700']
    ];
    
    $sizeClasses = $size === 'large' 
        ? 'text-base px-3 py-2 rounded-lg mr-2 font-medium' 
        : 'text-xs px-2 py-1 rounded-md mr-1 font-medium';
@endphp

<a href="{{ $href }}" 
   class="inline-block {{ $colors[$type]['bg'] }} text-white {{ $sizeClasses }} {{ $colors[$type]['hover'] }} transition-colors duration-100">
    {{ $slot }}
</a>