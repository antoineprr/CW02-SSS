<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Teams
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-sm ">
                <div class="p-3 text-gray-900">
                    <div class="space-y-2">
                        @forelse($teams as $team)
                            <x-team-header :team="$team" />
                        @empty
                            <p class="text-gray-500 text-center">No teams found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
