<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <header class="mb-6">
                    <h2 class="text-lg font-medium text-gray-900">
                        Create a new post
                    </h2>
                </header>

                <form method="post" action="{{ route('post.store') }}" class="space-y-6" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <x-input-label for="title" value="Title" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="body" value="Body" />
                        <textarea id="body" name="body" rows="6" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('body') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('body')" />
                    </div>

                    <div>
                        <x-input-label for="thumbnail" value="Thumbnail" />
                        <input 
                            id="thumbnail"
                            name="thumbnail"
                            type="file"
                            accept="image/png,image/jpeg,image/jpg"
                            class="mt-1 block w-full"
                        />
                        <x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />
                    </div>

                    <div class="flex items-center gap-4 justify-end">
                        <x-primary-button>Create Post</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
