@props(['player'])

@php
    $playerColor = $player->team->color ?? 'E5E7EB';
    $bgColor = '#' . ltrim($playerColor, '#');
    $textColor = \App\Http\Controllers\ColorController::getTextColor($playerColor);
@endphp
<div class="p-4" style="background-color: {{ $bgColor }}; color: {{ $textColor }};">
    <h3 class="text-lg font-medium">
        <a href="{{ route('articles.player', ['firstname' => $player->firstname, 'name' => $player->name]) }}" 
        class="hover:underline">
            {{ $player->firstname }} {{ $player->name }}
        </a>
        @if($player->position)
            <span class="text-sm font-normal" > - {{ $player->position->label }}</span>
        @endif
    </h3>
    <div class="text-sm mt-1">
        @if($player->team)
            <a href="{{ route('team.show', ['team' => $player->team->name]) }}" class="hover:underline">
                {{ $player->team->name }}
            </a>
        @endif
        @if($player->number)
            - #{{ $player->number }}
        @endif
        @if($player->age)
            - {{ $player->age }} years old
        @endif
        @if($player->country)
            - {{ $player->country->name }}
        @endif
    </div>
</div>