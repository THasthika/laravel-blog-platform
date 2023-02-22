<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <header>
        <div class="navbar bg-base-100">
            <div class="flex-none">
                <button class="btn btn-square btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block w-5 h-5 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            <div class="flex-1">
                <a href="{{route('home')}}" class="btn btn-ghost normal-case text-xl">Blog App</a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal px-1">
                    <li><a href="{{route('login')}}">Login</a></li>
                    <li><a href="{{route('register')}}">Register</a></li>
                    {{-- <li><a>Item 3</a></li> --}}
                </ul>
            </div>
        </div>
        {{-- <div class="container mx-auto sm:flex">
                <x-application-title></x-application-title>
                <div class="sm:flex-1">
                </div>
                <div class="sm:flex-none w-full sm:w-auto">
                    <ul class="text-center nav-links-wrapper">
                        <li>
                            <a href="/login" class="nav-link">Login</a>
                        </li>
                        <li>
                            <a href="/register" class="nav-link">Register</a>
                        </li>
                        <li>
                            <x-dark-mode-toggle>x</x-dark-mode-toggle>
                        </li>
                    </ul>
                </div>
            </div> --}}
    </header>

    {{-- <div class="flex flex-col sm:justify-center items-center mt-0 sm:mt-20 pt-6 sm:pt-0">
            
            <section class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </section>

        </div> --}}

</body>

</html>
