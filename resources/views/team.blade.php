<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $team->name }}
        </h2>
    </x-slot>
    
    <div class="pt-2 flex justify-center">
        <a href="{{ route('articles.team', $team->name) }}" 
            class="inline-flex items-center px-4 py-2 bg-slate-600 rounded-md font-semibold text-md text-white hover:bg-slate-700 transition-colors">
            View all posts for {{ $team->name }}
        </a>
    </div>

    <div class="pt-2 pb-4">
        <div class="max-w-7xl mx-auto px-6">
            <x-team-header :team="$team" />
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-white overflow-hidden shadow-sm ">
            <div class="py-3 px-6 text-gray-900">
                <div class="space-y-2">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Players
                    </h2>
                    <div class="grid grid-cols-4 gap-2 flex-col">
                        @forelse($team->players as $player)
                            <x-player-header :player="$player" />
                        @empty
                            <p class="text-gray-500 text-center">No players found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>