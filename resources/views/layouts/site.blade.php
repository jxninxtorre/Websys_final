<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tasks for Today')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-pink-50 text-gray-800 min-h-screen">
    <nav class="bg-white shadow">
        <div class="max-w-4xl mx-auto px-4 py-3 flex flex-wrap items-center gap-4">
            <span class="font-bold text-pink-600">Tasks for Today</span>
            <a href="{{ route('welcome') }}" class="hover:underline">Welcome</a>
            <a href="{{ route('tasks.index') }}" class="hover:underline">Task List</a>
            <a href="{{ route('my-profile') }}" class="hover:underline">Profile</a>
            <a href="{{ route('about') }}" class="hover:underline">About</a>

            <div class="ml-auto flex items-center gap-3">
                @auth
                    <span class="text-sm">Hi, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-red-600 hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="text-sm hover:underline">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 py-8">
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>