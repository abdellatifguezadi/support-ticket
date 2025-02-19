<x-guest-layout>
    <h2 class="text-2xl font-bold text-center mb-6 text-white ">{{ __('Welcome Back!') }}</h2>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
            <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500"
                type="password"
                name="password"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>


        <div class="mt-6">

            @if (Route::has('password.request'))
            <a class="text-sm text-emerald-600 hover:text-emerald-800 hover:underline" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif
        </div>
        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-emerald-600 hover:text-emerald-800 hover:underline" href="{{ route('register') }}">
                {{ __('Create new account') }}
            </a>
            <x-primary-button class="bg-emerald-600 hover:bg-emerald-700 focus:bg-emerald-700">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>