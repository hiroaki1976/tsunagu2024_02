<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" name="zipcloud" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        @push('scripts')
        <script src="{{ asset('js/zipcloud.js') }}" defer></script>
        @endpush

        <!-- Office Name -->
        <div>
            <x-input-label for="officename" :value="__('Officename')" />
            <x-text-input id="officename" class="block mt-1 w-full" type="text" name="officename" :value="old('officename', $user->officename)" required autofocus autocomplete="officename" />
            <x-input-error :messages="$errors->get('officename')" class="mt-2" />
        </div>

        <!-- Post Code -->
        <div>
            <x-input-label for="postcode" :value="__('Postcode')" />
            <x-text-input id="postcode" class="block mt-1 w-full" type="text" name="postcode" :value="old('postcode', $user->postcode)" autofocus autocomplete="postcode" placeholder="郵便番号" />
            <x-input-error :messages="$errors->get('postcode')" class="mt-2" />
        </div>

        <!-- Prefecture -->
        <div>
            <x-input-label for="prefecture" :value="__('Prefecture')" />
            <x-text-input id="prefecture" class="block mt-1 w-full" type="text" name="prefecture" :value="old('prefecture', $user->prefecture)" autofocus autocomplete="prefecture" placeholder="都道府県" />
            <x-input-error :messages="$errors->get('prefecture')" class="mt-2" />
        </div>

        <!-- City -->
        <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city', $user->city)" autofocus autocomplete="city" placeholder="市区町村" />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        <!-- Town -->
        <div>
            <x-input-label for="town" :value="__('Town')" />
            <x-text-input id="town" class="block mt-1 w-full" type="text" name="town" :value="old('town', $user->town)" autofocus autocomplete="town" placeholder="町名など" />
            <x-input-error :messages="$errors->get('town')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
