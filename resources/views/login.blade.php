@vite('resources/css/app.css')
@vite('resources/js/app.js')
<html>
    <head>
        <title>Laravel - Login</title>
    </head>
    <body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <form method="POST" action="{{ route('login') }}">
        @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="flex items-center justify-between mb-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                    <span class="ml-2 text-gray-700">Remember me</span>
                </label>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Login</button>
            </div>
        </form>
        <p class="text-center text-gray-700">Haven't you registered? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a></p>
    </div>
</body>
</html>
