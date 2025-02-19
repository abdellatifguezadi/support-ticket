<x-guest-layout>
    <h2 class="text-2xl font-bold text-center mb-6 text-white ">{{ __('Create Account') }}</h2>

    <form method="POST" action="{{ route('register') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-700" />
            <x-text-input id="name" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
            <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Add your additional fields here -->
        
        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-blue-600 hover:text-blue-800 hover:underline" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:bg-blue-700">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
