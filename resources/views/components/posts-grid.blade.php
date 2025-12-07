@props(['posts'])

<div class="py-6 px-12 mx-auto grid grid-cols-3 gap-4 items-stretch">
    @if(isset($posts[0]))
        <div class="col-span-2">
            <x-featured-post :post="$posts[0]" />
        </div>
    @endif
    
    @if(count($posts) > 1)
        <div>
            <div class="grid grid-cols-1 gap-2 h-full">
                @foreach($posts->slice(1, 4) as $post)
                    <x-article-overview :post="$post"/>
                @endforeach
            </div>
        </div>
    @endif
</div>