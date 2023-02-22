<header class="bg-primary">
    <div class="container mx-auto flex">
        <div>
            <a href="/"><h1 class="text-3xl text-gray-50 py-2 inline-block">Blog App</h1></a>
        </div>
        <div class="flex-grow"></div>
        <div class="h-auto">
            <ul class="flex h-full justify-center nav-links-wrapper">
                <li><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                <li><a href="{{ route('signup') }}" class="nav-link">Signup</a></li>
            </ul>
        </div>
    </div>
</header>