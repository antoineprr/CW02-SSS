<header class="bg-white border-b">
    <div class="mx-auto px-4 py-4 flex items-center justify-center">

        <!-- Logo -->
        <div class="">
            <a href="{{ route('home') }}">
                <x-application-full-logo/>
            </a>
        </div>

        <!-- Droite -->
        <div class="fixed top-0 right-0 p-6 text-right z-10">
            @auth
                <!-- TODO : Ajouter dropdown profil-->
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900">Log in</a>

                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900">Register</a>
            @endauth
        </div>

    </div>
</header>