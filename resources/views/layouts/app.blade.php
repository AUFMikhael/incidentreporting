<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Incident Reporting System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<nav class="bg-white shadow p-4 flex justify-between items-center">
    <a href="/" class="font-bold text-xl">Incident System</a>

    <div>
        @auth
            <span class="mr-4">Hello, {{ auth()->user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button class="text-red-600 font-semibold">Logout</button>
            </form>
        @endauth

        @guest
            <a href="/login" class="text-blue-600">Login</a>
        @endguest
    </div>
</nav>

<div class="container mx-auto p-6">
    @if(session('success'))
        <div class="bg-green-200 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')
</div>

</body>
</html>
