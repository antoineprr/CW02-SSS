<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Profile Information
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Update your account's profile information and email address.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Name" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="firstname" value="Firstname" />
            <x-text-input id="firstname" name="firstname" type="text" class="mt-1 block w-full" :value="old('firstname', $user->firstname)" required autofocus autocomplete="firstname" />
            <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        Your email address is unverified.

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mb-4 ">
            <x-input-label for="picture" value="Profile picture" />
            <div class="flex items-center gap-4 my-2">
                @if ($user->picture && Storage::disk('public')->exists($user->picture))
                    <img 
                        src="{{ asset('storage/' . $user->picture) }}" 
                        alt="Current photo" 
                        class="h-24 w-24 rounded-full object-cover"
                    >
                @else
                    <div class="h-24 w-24 rounded-full border-2 border-gray-300 flex items-center justify-center text-gray-400 font-medium">
                        No photo
                    </div>
                @endif

                <div class="flex-1">
                    <input 
                        id="picture"
                        name="picture"
                        type="file"
                        accept="image/png, image/jpeg, image/jpg"
                        class="mt-1 block w-full"
                    />
                    <x-input-error class="mt-2" :messages="$errors->get('picture')" />
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Save</x-primary-button>

             @if ($user->picture && Storage::disk('public')->exists($user->picture))
                <x-danger-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-picture-deletion')"
                >Delete current picture</x-danger-button>
            @endif
        </div>
    </form>

    @if ($user->picture && Storage::disk('public')->exists($user->picture))
        <x-modal name="confirm-picture-deletion" focusable>
            <form method="post" action="{{ route('profile.picture.delete') }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete your profile picture?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once your profile picture is deleted, it will be permanently removed.
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Cancel
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        Delete Picture
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    @endif

        
</section>
