<x-guest-layout>
    {{-- <x-authentication-card> --}}
    {{-- <x-slot name="logo">
        <x-authentication-card-logo />
    </x-slot> --}}

    <x-validation-errors class="mb-4" />

    @session('status')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ $value }}
        </div>
    @endsession

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-label for="username" value="{{ __('Username') }}" />
            <x-input id="username" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
        </div>

        <div class="mt-4">
            <div class="flex items-center justify-between">
                <x-label for="password" value="{{ __('Password') }}" />

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            {{-- <div>
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div> --}}
            <!-- Include Font Awesome or use your preferred icon library -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

            <div class="relative">
                <x-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required
                    autocomplete="current-password" />

                <button type="button" onclick="togglePassword()"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 text-gray-500">
                    <i id="eyeIcon" class="far fa-eye"></i>
                </button>
            </div>

            <script>
                function togglePassword() {
                    const passwordInput = document.getElementById("password");
                    const icon = document.getElementById("eyeIcon");
                    const isHidden = passwordInput.type === "password";

                    passwordInput.type = isHidden ? "text" : "password";
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                }
            </script>
        </div>



        <div class="flex items-center justify-between mt-4">
            <div class="block">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            @if (Route::has('register'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('register') }}">
                    {{ __('Create an account') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-button class="w-full py-2">
                {{ __('Log in') }}
            </x-button>
        </div>

    </form>
    {{-- </x-authentication-card> --}}
</x-guest-layout>
