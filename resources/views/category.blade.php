<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if($type === 'category')
                Posts in category: {{ $categoryLabel }}
            @elseif($type === 'team')
                Posts for team: {{ $categoryLabel }}
            @elseif($type === 'player')
                Posts about {{ $categoryLabel->firstname }} {{ $categoryLabel->name }}
            @endif
        </h2>
    </x-slot>

    <div class="px-6 pt-3">
        @if($type === 'category')
            <div class="bg-white shadow p-3">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Posts in category: {{ $categoryLabel }}
                </h2>
            </div>
        @elseif($type === 'team')
            <x-team-header :team="$categoryLabel" />
        @elseif($type === 'player')
            <x-player-header :player="$categoryLabel" />
        @endif
    </div>

    @if($posts->count() > 0)
        <x-posts-grid :posts="$posts" />
    @else
        <div class="py-12 px-12 mx-auto text-center">
            <h3 class="text-lg font-medium text-gray-900 mb-2">No posts found</h3>
            @if($type === 'category')
                <p class="text-gray-600">There are no posts in the "{{ $categoryLabel }}" category yet.</p>
            @elseif($type === 'team')
                <p class="text-gray-600">There are no posts for the {{ $categoryLabel }} team yet.</p>
            @elseif($type === 'player')
                <p class="text-gray-600">There are no posts about {{ $categoryLabel->firstname }} {{ $categoryLabel->name }} yet.</p>
            @endif
        </div>
    @endif
</x-app-layout>