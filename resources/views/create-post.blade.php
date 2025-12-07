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
                        <x-input-label for="slug" value="Slug" />
                        <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('slug')" />
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

                    <div class="grid grid-cols-3 gap-2">
                        <div class="col-span-1">
                            <x-input-label for="categories" value="Categories" />
                            <select id="categories" name="categories[]" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" size="5">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                        {{ $category->label }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-sm text-gray-600">Hold Ctrl (or Cmd on Mac) to select multiple categories</p>
                            <x-input-error class="mt-2" :messages="$errors->get('categories')" />
                        </div>
                        <div class="col-span-1">
                            <x-input-label for="teams" value="Teams" />
                            <select id="teams" name="teams[]" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" size="5">
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" 
                                            {{ in_array($team->id, old('teams', [])) ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-sm text-gray-600">Hold Ctrl (or Cmd on Mac) to select multiple teams</p>
                            <x-input-error class="mt-2" :messages="$errors->get('teams')" />
                        </div>
                        <div class="col-span-1">
                            <x-input-label for="players" value="Players" />
                            <select id="players" name="players[]" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" size="5">
                                @foreach($players as $player)
                                    <option value="{{ $player->id }}" 
                                            {{ in_array($player->id, old('players', [])) ? 'selected' : '' }}>
                                        {{ $player->firstname }} {{ $player->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-sm text-gray-600">Hold Ctrl (or Cmd on Mac) to select multiple players</p>
                            <x-input-error class="mt-2" :messages="$errors->get('players')" />
                        </div>
                    </div>

                    <div class="flex items-center gap-4 justify-end">
                        <x-primary-button>Create Post</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('title').addEventListener('input', function() {
            const title = this.value;
            const slug = title
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-') 
                .replace(/^-|-$/g, '');
            
            document.getElementById('slug').value = slug;
        });
    </script>
</x-app-layout>
