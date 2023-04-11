<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blog App') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="">
    <div class="drawer">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <header class="bg-gray-100">
                <div class="container mx-auto navbar">
                    <div class="flex-none">
                        <button onclick="toggleDrawer()" class="btn btn-square btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 class="inline-block w-5 h-5 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1">
                        <a href="{{ route('home') }}" class="btn btn-ghost normal-case text-xl">Blog App</a>
                    </div>
                    <div class="flex-none">
                        <ul class="menu menu-horizontal px-1">
                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                            <li><a href="{{ route('post.list') }}">{{__('Posts')}}</a></li>
                            @if (Auth::user() && Auth::user()->isAdmin())
                                <li><a href="/">{{__('Users')}}</a></li>
                            @endif
                            @if (Auth::guest())
                                <li><a href="{{ route('login') }}">{{__('Login')}}</a></li>
                                <li><a href="{{ route('register') }}">{{__('Register')}}</a></li>
                            @else
                                {{-- <li class="text-primary-content"><a class="btn btn-primary btn-sm text-sm" href="{{ route('login') }}">New Post</a></li> --}}
                            @endif
                            {{-- <li><a>Item 3</a></li> --}}
                        </ul>
                        @if (!Auth::guest())
                            <div class="ml-4 dropdown dropdown-end">
                                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                                    <div class="w-10 rounded-full">
                                        @if (Auth::user()->image)
                                            <img src="{{asset('storage/'.Auth::user()->image)}}"/>
                                        @else
                                            <img
                                                src="https://via.placeholder.com/60x60.png?text={{Auth::user()->username[0]}}"/>
                                        @endif
                                    </div>
                                </label>
                                <ul tabindex="0"
                                    class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                                    <li>
                                        <a href="{{route('profile.edit')}}" class="justify-between">
                                            {{__('Profile')}}
                                        </a>
                                    </li>

                                    <li>
                                        <!-- Authentication -->
                                        <form class="block" method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <a class="block" href="{{route('logout')}}"
                                               onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>

                </div>
            </header>
            <main>
                {{ $slot }}
            </main>
        </div>
        <div class="drawer-side">
            <label for="my-drawer" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 bg-base-100 text-base-content">
                <!-- Sidebar content here -->
                <li><a>Sidebar Item 1</a></li>
                <li><a>Sidebar Item 2</a></li>
            </ul>

        </div>
    </div>

    @livewireScripts
</body>
</html>
