@props(['post'])

<div class="h-full bg-white overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-200">
    <div class="grid grid-cols-4 items-center h-full">
        <div class="col-span-1 p-2 flex justify-center">
            <a href="{{ route('post.show', $post->slug) }}">
                @if($post->thumbnail)
                    <div class="aspect-square w-full rounded-md overflow-hidden">
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }} thumbnail" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="aspect-square w-full rounded-md overflow-hidden">
                        <img src="{{ asset('images/base-thumbnail.jpg') }}" alt="base thumbnail" class="w-full h-full object-cover">
                    </div>
                @endif
            </a>
        </div>

        <div class="col-span-3 flex flex-auto">
            <div class="px-2 py-4 text-gray-900 flex-1 flex flex-col justify-center">
                @if($post->categories->count() > 0 || $post->teams->count() > 0 || $post->players->count() > 0)
                    <div class="mb-2 flex flex-wrap gap-1">
                        @foreach($post->categories as $category)
                            <a href="{{ route('category.show', $category->label) }}" class="inline-block bg-slate-800 text-white text-xs px-2 py-1 rounded mr-1 hover:bg-slate-700 transition-colors">
                                {{ $category->label }}
                            </a>
                        @endforeach
                        @foreach($post->teams as $team)
                            <a href="{{ route('team.show', $team->name) }}" class="inline-block bg-lime-600 text-white text-xs px-2 py-1 rounded mr-1 hover:bg-lime-700 transition-colors">
                                {{ $team->name }}
                            </a>
                        @endforeach
                        @foreach($post->players as $player)
                            <a href="{{ route('player.show', ['firstname' => $player->firstname, 'name' => $player->name]) }}" class="inline-block bg-yellow-600 text-white text-xs px-2 py-1 rounded mr-1 hover:bg-yellow-700 transition-colors">
                                {{ $player->firstname }} {{ $player->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
                <a href="{{ route('post.show', $post->slug) }}">
                    <h3 class="text-lg font-semibold mb-2 hover:text-gray-700 transition-colors">{{ $post->title }}</h3>
                </a>
            </div>
        </div>
    </div>
</div>