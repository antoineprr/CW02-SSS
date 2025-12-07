<header class="bg-slate-800 border-b border-slate-950">
    <div class="mx-auto px-4 py-2 flex items-center justify-center relative">

        <a href="{{ route('home') }}" class="flex justify-center">
            <x-application-full-logo class="h-8 w-auto" />
        </a>

        <div class="absolute top-1/2 transform -translate-y-1/2 right-0 mr-2 text-right">
            @auth
                <div class="flex items-center mr-2">
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button class="transition ease-in-out duration-150 h-11 w-11 rounded-full border-2 bg-brand-primary flex items-center justify-center overflow-hidden">
                                @if (Auth::user()->picture && Storage::disk('public')->exists(Auth::user()->picture))
                                    <img 
                                        src="{{ asset('storage/' . Auth::user()->picture) }}" 
                                        alt="Current photo" 
                                        class="h-full w-full object-cover"
                                    >
                                @else
                                    <span class="text-slate-800 font-medium">
                                        {{ strtoupper(substr(Auth::user()->firstname, 0, 1) . substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                @endif
                            </button>
                        </x-slot>


                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    Log out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

            @else

                <a href="{{ route('login') }}"
                    class="font-semibold text-brand-primary hover:text-brand-accent transition">
                    Log in
                </a>

                <a href="{{ route('register') }}"
                    class="ml-4 font-semibold text-brand-primary hover:text-brand-accent transition">
                    Register
                </a>

            @endauth
        </div>

    </div>
</header>
