@props(['player'])

<div class="bg-white shadow p-3">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Posts about {{ $player->firstname }} {{ $player->name }}
    </h2>
</div>