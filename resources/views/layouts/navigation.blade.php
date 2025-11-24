<nav class="bg-white border-b border-gray-100">
    <div class="mx-0 px-2">
        <div class="flex justify-between h-12">
            <div class="space-x-8 -my-px ms-8 flex">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    Latest News
                </x-nav-link>
                <x-nav-link :href="route('players')" :active="request()->routeIs('players')">
                    Players
                </x-nav-link>
                <x-nav-link :href="route('teams')" :active="request()->routeIs('teams')">
                    Teams
                </x-nav-link>
                {{-- <x-nav-link :href="route('search')" :active="request()->routeIs('search')">
                    Search Articles
                </x-nav-link> --}}
            </div>
        </div>
    </div>
</nav>
