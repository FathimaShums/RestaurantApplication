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
                <button id="loginButton" class="bg-green-500 text-white px-4 py-2 rounded">
                    Login
                </button>
                <!-- Modal -->
                <div id="loginModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center z-50">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
                        <h2 class="text-lg font-bold mb-4">Login</h2>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700">Name</label>
                                <input type="text" id="name" name="name" class="border border-gray-300 rounded w-full p-2" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700">Password</label>
                                <input type="password" id="password" name="password" class="border border-gray-300 rounded w-full p-2" required>
                            </div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Login</button>
                        </form>
                    </div>
                </div>
                
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