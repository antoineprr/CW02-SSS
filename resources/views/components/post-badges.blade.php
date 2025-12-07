@props(['post', 'size' => 'small'])

@if($post->categories->count() > 0 || $post->teams->count() > 0 || $post->players->count() > 0)
    <div class="mb-2 {{ $size === 'large' ? 'flex flex-wrap gap-1' : 'flex flex-wrap gap-1' }}">
        @foreach($post->categories as $category)
            <x-badge :href="route('articles.category', $category->label)" type="category" :size="$size">
                {{ $category->label }}
            </x-badge>
        @endforeach
        @foreach($post->teams as $team)
            <x-badge :href="route('articles.team', $team->name)" type="team" :size="$size" :color="$team->color">
                {{ $team->name }}
            </x-badge>
        @endforeach
        @foreach($post->players as $player)
            <x-badge :href="route('articles.player', ['firstname' => $player->firstname, 'name' => $player->name])" type="player" :size="$size">
                {{ $player->firstname }} {{ $player->name }}
            </x-badge>
        @endforeach
    </div>
@endif