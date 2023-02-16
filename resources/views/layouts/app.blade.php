<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Blog App - @yield('title')</title>
</head>

<body>
    {{-- @section('sidebar')
        This is the master sidebar.
    @show --}}

    <header class="bg-primary">
        <div class="container mx-auto flex">
            <div>
                <a href="/"><h1 class="text-3xl text-gray-50 py-2 inline-block">Blog App</h1></a>
            </div>
            <div class="flex-grow"></div>
            <div class="h-auto">
                <ul class="flex h-full justify-center nav-links-wrapper">
                    <li><a href="/" class="nav-link">Login</a></li>
                    <li><a href="/" class="nav-link">Signup</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 md:flex">
       

        <section class="flex-1 bg-gray-400">
            @yield('content')
        </section>

        <aside class="lg:w-1/4 md:w-1/3 bg-gray-700">
            @yield('sidebar')
        </aside>

    </div>
</body>

</html>
