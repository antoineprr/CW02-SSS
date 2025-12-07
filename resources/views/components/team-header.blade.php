@props(['team'])

@php
    use App\Http\Controllers\ColorController;
    
    $bgColor = $team->color ? '#' . ltrim($team->color, '#') : '#1F2937';
    $textColor = ColorController::getTextColor($team->color);
@endphp

<div class="shadow p-6" style="background-color: {{ $bgColor }}; color: {{ $textColor }};">
    <div class="flex items-center gap-4">
        @if($team->logo)
            <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }} logo" class="w-24 h-24 object-contain rounded-lg bg-white/20 p-2">
        @else
            <img src="{{ asset('images/base-thumbnail.jpg') }}" alt="Default team logo" class="w-24 h-24 object-contain rounded-lg bg-white/20 p-2 overflow-hidden">
        @endif
        
        <div class="flex-1">
            <h1 class="text-3xl font-bold mb-2">
                <a href="{{ route('team.show', $team) }}" class="hover:underline">{{ $team->name }}</a>
            </h1>
            <p class="text-lg mb-1">Location: {{ $team->location }}</p>
            <p class="text-base">{{ $team->description }}</p>
        </div>
    </div>
</div>