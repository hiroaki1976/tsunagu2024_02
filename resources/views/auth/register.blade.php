<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" name="zipcloud">
        @csrf
        @push('scripts')
        <script src="{{ asset('js/zipcloud.js') }}" defer></script>
        @endpush

        <!-- Office Name -->
        <div>
            <x-input-label for="officename" :value="__('Officename')" />
            <x-text-input id="officename" class="block mt-1 w-full" type="text" name="officename" :value="old('officename')" required autofocus autocomplete="officename" placeholder="事業所名を入力して下さい" />
            <x-input-error :messages="$errors->get('officename')" class="mt-2" />
        </div>

        <!-- Post Code -->
        <div>
            <x-input-label for="postcode" :value="__('Postcode')" />
            <x-text-input id="postcode" class="block mt-1 w-full" type="text" name="postcode" :value="old('postcode')" autofocus autocomplete="postcode" placeholder="郵便番号" />
            <x-input-error :messages="$errors->get('postcode')" class="mt-2" />
        </div>

        <!-- Prefecture -->
        <div>
            <x-input-label for="prefecture" :value="__('Prefecture')" />
            <x-text-input id="prefecture" class="block mt-1 w-full" type="text" name="prefecture" :value="old('prefecture')" autofocus autocomplete="prefecture" placeholder="都道府県" />
            <x-input-error :messages="$errors->get('prefecture')" class="mt-2" />
        </div>

        <!-- City -->
        <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" autofocus autocomplete="city" placeholder="市区町村" />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        <!-- Town -->
        <div>
            <x-input-label for="town" :value="__('Town')" />
            <x-text-input id="town" class="block mt-1 w-full" type="text" name="town" :value="old('town')" autofocus autocomplete="town" placeholder="町名など" />
            <x-input-error :messages="$errors->get('town')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="ご担当者様の氏名を入力して下さい" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="（例）xxx@gmail.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="半角英数字記号でご入力下さい" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="上と同じパスワードをご入力下さい" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
