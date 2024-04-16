<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Laravel App</title>
    
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    
    <header class="bg-blue-500 text-white py-4">
        <div class="container mx-auto">
            <h1 class="text-2xl font-semibold">Your Website</h1>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="container mx-auto mt-8">
        <!-- Content Section -->
        @yield('content')
    </main>

    <!-- Footer Section -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto">
            <p>&copy; {{ date('Y') }} Your Website. All rights reserved.</p>
            <!-- Add any other footer content here -->
        </div>
    </footer>
</body>
</html>
