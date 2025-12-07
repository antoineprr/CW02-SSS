<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Articles
        </h2>
    </x-slot>

    <div class="px-12 pt-3">
    </div>
    @if($posts->count() > 0)
        <div class="px-12 py-3">
            <div class="text-gray-900">
                <div class="grid grid-cols-3 gap-4 items-stretch">
                    @foreach($posts->skip(5) as $post)
                        <x-article-list :post="$post" />
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="py-10 px-10 mx-auto text-center bg-white shadow-sm rounded-lg max-w-2xl mt-4">
            <h3 class="text-lg font-medium text-gray-900 mb-2">No posts found</h3>
        </div>
    @endif
    
</x-app-layout>