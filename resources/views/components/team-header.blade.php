@props(['team'])

<div class="bg-white shadow p-3">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Posts for team: {{ $team->name }}
    </h2>
</div>