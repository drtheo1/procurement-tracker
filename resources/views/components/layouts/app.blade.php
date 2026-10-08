@props(['title' => 'Procurement Request Tracker'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-zinc-900">
    <nav class="border-b">
        <div class="max-w-5xl mx-auto flex gap-6 p-4">
            <a href="{{ route('home') }}" class="font-semibold">Procurement Tracker</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('contact') }}">Contact</a>
            <span class="flex-1"></span>
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Log in</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <main class="px-4">
        {{ $slot }}
    </main>

    <footer class="border-t mt-12 p-4 text-sm text-center">
        Procurement Request Tracker, CODE University of Applied Sciences
    </footer>
</body>
</html>
