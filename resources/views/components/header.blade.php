<header class="bg-slate-800 border-b border-slate-950">
    <div class="mx-auto px-4 py-2 flex items-center justify-center relative">

        <a href="{{ route('home') }}" class="flex justify-center">
            <x-application-full-logo class="h-8 w-auto" />
        </a>

        <div class="absolute top-1/2 transform -translate-y-1/2 right-0 mr-2 text-right">
            @auth
                <div class="flex items-center ms-4">
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-800 bg-[#E0B7C3] hover:text-slate-950 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }} {{ Auth::user()->firstname }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4 text-slate-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
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
                    <div class="ml-2">
                        @if (Auth::user()->picture && Storage::disk('public')->exists(Auth::user()->picture))
                            <img 
                                src="{{ asset('storage/' . Auth::user()->picture) }}" 
                                alt="Current photo" 
                                class="h-10 w-10 rounded-full object-cover"
                            >
                        @endif
                    </div>
                </div>

                
            @else
                <a href="{{ route('login') }}"
                    class="font-semibold text-[#E0B7C3] hover:text-[#F2CEDA] transition">
                    Log in
                </a>

                <a href="{{ route('register') }}"
                    class="ml-4 font-semibold text-[#E0B7C3] hover:text-[#F2CEDA] transition">
                    Register
                </a>
            @endauth
        </div>

    </div>
</header>
