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

<body class="w-full">
    <header class="bg-gray-100">
        <div class="container mx-auto navbar">
            <div class="flex-1">
                <a href="{{ route('home') }}" class="btn btn-ghost normal-case text-xl">Blog App</a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal px-1">
                    <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                    <li><a href="{{ route('post.list') }}">{{__('Posts')}}</a></li>
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">{{__('Login')}}</a></li>
                        <li><a href="{{ route('register') }}">{{__('Register')}}</a></li>
                    @else
                        <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>


                    @endif
                </ul>
                @if (!Auth::guest())
                    <div class="ml-4 dropdown dropdown-end">
                        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                            <div>
                                <x-icon-bell class="w-10 rounded-full" />
                            </div>
                        </label>
                            <ul tabindex="0" class="mt-3 p-2 shadow dropdown-content bg-base-100 w-52">
                                @foreach($notifications as $notification)
                                    <li class="my-3 hover:cursor-pointer px-2 text-sm">
                                        <div class="flex flex-col space-y-2">
                                            <span>{{$notification->content}}</span>
                                            <span class="text-right">{{$notification->created_at->diffForHumans()}}</span>
                                        </div>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{route('notification.show')}}" class="w-full btn btn-sm btn-ghost">
                                        {{__('View All')}}
                                    </a>
                                </li>
                            </ul>
                    </div>
                    <div class="ml-4 dropdown dropdown-end">
                        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img src="{{Auth::user()->imageUrl}}"/>
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

    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
</body>
</html>
