@vite('resources/css/app.css')
@vite('resources/js/app.js')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Laravel - Register</title>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
    <div class="flex items-center justify-between mb-6">
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline flex items-center">
                <i class="fas fa-arrow-left mr-2 hover:no-underline"></i>
            </a>
            <h2 class="text-2xl font-bold text-center">Register</h2>
            <div class="flex-row"></div>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded mt-1" required autofocus>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="firstName" class="block text-gray-700">First name</label>
                <input type="text" id="firstName" name="firstName" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('firstName')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Last name</label>
                <input type="text" id="lastName" name="lastName" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('lastName')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Phone</label>
                <input type="text" id="phone" name="phone" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center justify-between mb-6">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 w-full">Register</button>
            </div>
        </form>
    </div>
</body>
</html>
