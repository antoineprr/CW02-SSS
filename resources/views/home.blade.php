<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Latest News
        </h2>
    </x-slot>

    <div class="py-6 px-12 mx-auto grid grid-cols-3 gap-4 items-stretch">
        <div class="col-span-2">
            <a href="{{ route('post.show', $posts[0]->slug) }}" class="block bg-white overflow-hidden h-full py-4 hover:shadow-lg transition-shadow duration-200">
                @if($posts[0]->thumbnail)
                    <div class="px-6">
                        <div class="aspect-video max-h-72 w-full mx-auto rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $posts[0]->thumbnail) }}" alt="{{ $posts[0]->title }} thumbnail" class="w-full h-full object-cover">
                        </div>
                    </div>
                @else
                    <div class="px-6">
                        <div class="aspect-video max-h-72 w-full mx-auto rounded-lg overflow-hidden">
                            <img src="{{ asset('images/base-thumbnail.jpg') }}" alt="base thumbnail" class="w-full h-full object-cover">
                        </div>
                    </div>
                @endif

                <div class="px-8 my-4">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2 ">{{ $posts[0]->title }}</h1>
                    <p class="text-gray-700 text-lg">{{ $posts[0]->excerpt(200) }}</p>
                </div>
            </a>
        </div>
        <div>
            <div class="grid grid-cols-1 gap-2 h-full">
                <x-article-overview :post="$posts[1]" :excerptLength="80" />
                <x-article-overview :post="$posts[2]" :excerptLength="80" />
                <x-article-overview :post="$posts[3]" :excerptLength="80" />
                <x-article-overview :post="$posts[4]" :excerptLength="80" />
            </div>
        </div>
    </div>
</x-app-layout>
