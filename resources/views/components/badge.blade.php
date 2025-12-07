@props(['href', 'type' => 'category', 'size' => 'small', 'color' => null])

@php
    use App\Http\Controllers\ColorController;
    
    $colors = [
        'category' => ['bg' => 'bg-purple-600'],
        'team' => ['bg' => 'bg-teal-600'],
        'player' => ['bg' => 'bg-amber-600']
    ];
    
    $sizeClasses = $size === 'large' 
        ? 'text-base px-3 py-2 rounded-lg mr-2 font-medium' 
        : 'text-xs px-2 py-1 rounded-md mr-1 font-medium';
@endphp

@if($color)
    @php
        $bgColor = str_starts_with($color, '#') ? $color : '#' . $color;
        $textColor = ColorController::getTextColor($color);
    @endphp
    <a href="{{ $href }}" 
       style="background-color: {{ $bgColor }}; color: {{ $textColor }};"
       class="inline-block {{ $sizeClasses }} transition-colors duration-100">
        {{ $slot }}
    </a>
@else
    <a href="{{ $href }}" 
       class="inline-block {{ $colors[$type]['bg'] }} text-white {{ $sizeClasses }} transition-colors duration-100">
        {{ $slot }}
    </a>
@endif