@props(['post'])

<div class="h-full">
    <a href="{{ route('post.show', $post->slug) }}" class="bg-white overflow-hidden shadow-sm h-full flex flex-col justify-center hover:shadow-lg transition-shadow duration-200">
        <div class="grid grid-cols-4 items-center">
            <div class="col-span-1 p-2 flex justify-center">
                @if($post->thumbnail)
                    <div class="aspect-square w-full rounded-md overflow-hidden">
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }} thumbnail" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="aspect-square w-full rounded-md overflow-hidden">
                        <img src="{{ asset('images/base-thumbnail.jpg') }}" alt="base thumbnail" class="w-full h-full object-cover">
                    </div>
                @endif
            </div>

            <div class="col-span-3 flex flex-auto">
                <div class="px-2 py-4 text-gray-900 flex-1 flex flex-col justify-center">
                    @if($post->categories->count() > 0)
                        <div class="mb-1">
                            @foreach($post->categories as $category)
                                <a href="{{ route('category.show', $category->label) }}" class="inline-block bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded mr-1 hover:bg-gray-300 transition-colors">
                                    {{ $category->label }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                    <h3 class="text-lg font-semibold mb-2">{{ $post->title }}</h3>
                </div>
            </div>
        </div>
    </a>
</div>