<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Latest News
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto px-6">
            <div class="grid grid-cols-5 gap-4">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg col-span-3">
                    <div class="p-6 text-gray-900">
                            {{ $posts[1]->title }}
                    </div>
                </div>
                <div class="grid grid-rows-2 col-span-2 gap-2">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6 text-gray-900">
                                {{ $posts[1]->title }}
                        </div>
                    </div>
                    
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6 text-gray-900">
                                {{ $posts[1]->title }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
