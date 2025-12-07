@props(['post'])

<div class="block bg-white overflow-hidden h-full py-4">
    <a href="{{ route('post.show', $post->slug) }}">
        @if($post->thumbnail)
            <div class="px-6">
                <div class="aspect-video max-h-72 w-full mx-auto rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }} thumbnail" class="w-full h-full object-cover">
                </div>
            </div>
        @else
            <div class="px-6">
                <div class="aspect-video max-h-72 w-full mx-auto rounded-lg overflow-hidden">
                    <img src="{{ asset('images/base-thumbnail.jpg') }}" alt="base thumbnail" class="w-full h-full object-cover">
                </div>
            </div>
        @endif
    </a>

    <div class="px-8 my-4">
        <x-post-badges :post="$post" size="large" />
        <a href="{{ route('post.show', $post->slug) }}">
            <h1 class="text-2xl font-bold text-gray-900 mb-2 hover:text-gray-700 transition-colors">{{ $post->title }}</h1>
        </a>
        <p class="text-gray-700 text-lg">{{ $post->excerpt(200) }}</p>
    </div>
</div>