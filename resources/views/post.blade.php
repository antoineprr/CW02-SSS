<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-2 px-12 mx-auto gap-4 items-stretch">
        <div class="bg-white overflow-hidden h-full py-4">
            <div class="px-8 my-4">
                <h1 class="text-2xl font-bold text-gray-900 mb-2 ">{{ $post->title }}</h1>
                <p class="text-gray-700 text-lg">{!! $post->getArticleInfos() !!}</p>
            </div>
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

            <div class="px-8 my-4">
                <p class="text-gray-700 text-lg">{{ $post->body }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
