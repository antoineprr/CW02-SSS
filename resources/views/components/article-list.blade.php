@props(['post'])

<div class="bg-white h-full">
    <div class="grid grid-cols-4 items-center h-full">
        <div class="col-span-1 p-2 flex justify-center">
            <a href="{{ route('post.show', $post->slug) }}">
                @if($post->thumbnail)
                    <div class="w-16 h-16 rounded-md overflow-hidden">
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }} thumbnail" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="w-16 h-16 rounded-md overflow-hidden">
                        <img src="{{ asset('images/base-thumbnail.jpg') }}" alt="base thumbnail" class="w-full h-full object-cover">
                    </div>
                @endif
            </a>
        </div>

        <div class="col-span-3 flex flex-auto">
            <div class="px-2 py-2 text-gray-900 flex-1 flex flex-col justify-center">
                <x-post-badges :post="$post" size="small" />
                <a href="{{ route('post.show', $post->slug) }}">
                    <h3 class="text-base font-semibold mb-1 hover:text-gray-700 transition-colors">{{ $post->title }}</h3>
                </a>
            </div>
        </div>
    </div>
</div>