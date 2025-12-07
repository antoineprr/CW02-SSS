<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Posts in category: {{ $categoryLabel }}
        </h2>
    </x-slot>

    @if($posts->count() > 0)
        <x-posts-grid :posts="$posts" />
    @else
        <div class="py-12 px-12 mx-auto text-center">
            <h3 class="text-lg font-medium text-gray-900 mb-2">No posts found</h3>
            <p class="text-gray-600">There are no posts in the "{{ $categoryLabel }}" category yet.</p>
        </div>
    @endif
</x-app-layout>