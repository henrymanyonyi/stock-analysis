{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FSM') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>

    @livewireScripts
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stock Analysis System') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#4885ed',
                        'primary-dark': '#3b78e7',
                        'sidebar': '#f7f9fc',
                        'accent-blue': '#4872e8',
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom styles for independent scrolling */
        .sidebar-scroll {
            height: calc(100vh - 60px);
            /* Adjust based on admin dropdown height */
        }
    </style>
    @stack('styles')
    <!-- Styles -->
    @livewireStyles
</head>

<body class="bg-blue-100 flex flex-col items-center justify-center min-h-screen">


    {{-- <!-- Logo -->
    <div class="p-3 border-b border-gray-200">
        <img src="{{ URL::asset('images/Logo-3.png') }}" alt="logo" class="h-16 object-contain">
    </div> --}}

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">

        {{ $slot }}

        {{-- <!-- Username -->
        <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <input type="email" id="username" placeholder="admin@fsm.co.ke"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <div class="flex justify-between items-center">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
            </div>
            <input type="password" id="password" placeholder="••••••••"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <!-- Remember me -->
        <div class="mb-6 flex items-center">
            <input type="checkbox" id="remember"
                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
            <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
        </div>

        <!-- Login Button -->
        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            Log in
        </button> --}}
    </div>

    {{-- <div class="mt-4 w-full max-w-sm">
        <img src="{{ URL::asset('images/Logo-1.png') }}" class=" w-full object-contain">
    </div> --}}

    @livewireScripts
    @stack('scripts')
</body>

</html>
