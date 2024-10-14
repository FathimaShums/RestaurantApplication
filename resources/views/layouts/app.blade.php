<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Restaurant Application')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    @auth
        @if(auth()->user()->user_type === 'Employee')
            <header class="bg-blue-500 text-white p-4">
                <h1 class="text-xl font-bold">Employee Dashboard</h1>
                <!-- Add employee-specific navigation here -->
            </header>
        @else
            <header class="bg-green-500 text-white p-4">
                <h1 class="text-xl font-bold">Customer Dashboard</h1>
                <!-- Add customer-specific navigation here -->
                <a href="{{ route('logoutCustomer') }}" class="text-white hover:underline mr-4">Log Out</a>
            </header>
        @endif
    @else
        <header class="bg-gray-500 text-white p-4">
            <h1 class="text-xl font-bold">Welcome to Our Restaurant</h1>
            <nav>
                <a href="{{ route('register.show') }}" class="text-white hover:underline mr-4">Register</a>
                <a href="" class="text-white hover:underline">Login</a>
            </nav>
        </header>
    @endauth

    <main class="p-6">
        @yield('content')
    </main>

    <footer class="bg-green-500 text-white p-4">
        <p>Your Application Footer</p>
    </footer>

    @vite('resources/js/app.js')
</body>
</html>