@props(['post'])

<div class="block bg-white overflow-hidden h-full py-4 hover:shadow-lg transition-shadow duration-200">
    <a href="{{ route('post.show', $post->slug) }}">
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
    </a>

    <div class="px-8 my-4">
        @if($post->categories->count() > 0 || $post->teams->count() > 0 || $post->players->count() > 0)
            <div class="mb-2">
                @foreach($post->categories as $category)
                    <a href="{{ route('category.show', $category->label) }}" class="inline-block bg-slate-800 text-white text-sm px-2 py-1 rounded-lg mr-2 hover:bg-slate-700 transition-colors">
                        {{ $category->label }}
                    </a>
                @endforeach
                @foreach($post->teams as $team)
                    <a href="{{ route('team.show', $team->name) }}" class="inline-block bg-lime-600 text-white text-sm px-2 py-1 rounded-lg mr-2 hover:bg-lime-700 transition-colors">
                        {{ $team->name }}
                    </a>
                @endforeach
                @foreach($post->players as $player)
                    <a href="{{ route('player.show', ['firstname' => $player->firstname, 'name' => $player->name]) }}" class="inline-block bg-yellow-700 text-white text-sm px-2 py-1 rounded-lg mr-2 hover:bg-yellow-600 transition-colors">
                        {{ $player->firstname }} {{ $player->name }}
                    </a>
                @endforeach
            </div>
        @endif
        <a href="{{ route('post.show', $post->slug) }}">
            <h1 class="text-2xl font-bold text-gray-900 mb-2 hover:text-gray-700 transition-colors">{{ $post->title }}</h1>
        </a>
        <p class="text-gray-700 text-lg">{{ $post->excerpt(200) }}</p>
    </div>
</div>