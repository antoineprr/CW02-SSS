@props(['post'])

<div class="h-full">
    <div class="bg-white overflow-hidden shadow-sm h-full flex flex-col justify-center">
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
                    <h3 class="text-lg font-semibold mb-2">{{ $post->title }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>