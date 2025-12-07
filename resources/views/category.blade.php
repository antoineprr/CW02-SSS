<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if($type === 'category')
                Posts in category: {{ $categoryLabel }}
            @elseif($type === 'team')
                Posts for team: {{ $categoryLabel }}
            @elseif($type === 'player')
                Posts about {{ $categoryLabel->firstname }} {{ $categoryLabel->name }}
            @elseif($type === 'author')
                Posts by {{ $categoryLabel->firstname }} {{ $categoryLabel->name }}
            @endif
        </h2>
    </x-slot>

    <div class="px-12 pt-3">
        @if($type === 'category')
            <div class="bg-white shadow p-3">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Posts in category: {{ $categoryLabel }}
                </h2>
            </div>
        @elseif($type === 'author')
            <div class="bg-white shadow p-3">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Posts by {{ $categoryLabel->firstname }} {{ $categoryLabel->name }}
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
        @if ($posts->count() > 5)
            <div class="px-12 py-3">
                <div class="text-gray-900">
                    <div class="grid grid-cols-2 gap-2 items-stretch">
                        @foreach($posts->skip(5) as $post)
                            <x-article-list :post="$post" />
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="py-10 px-10 mx-auto text-center bg-white shadow-sm rounded-lg max-w-2xl mt-4">
            <h3 class="text-lg font-medium text-gray-900 mb-2">No posts found</h3>
            @if($type === 'category')
                <p class="text-gray-600">There are no posts in the "{{ $categoryLabel }}" category yet.</p>
            @elseif($type === 'team')
                <p class="text-gray-600">There are no posts for the {{ $categoryLabel->name }} team yet.</p>
            @elseif($type === 'player')
                <p class="text-gray-600">There are no posts about {{ $categoryLabel->firstname }} {{ $categoryLabel->name }} yet.</p>
            @endif
        </div>
    @endif
    
</x-app-layout>