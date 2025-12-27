<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Violet Network - Helpdesk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-white">
    <nav class="fixed w-full z-50 bg-white shadow-sm h-20 flex items-center">
        <div class="max-w-7xl mx-auto px-6 w-full flex justify-between items-center">
            <a href="/" class="flex items-center gap-2">
                <i class="fas fa-network-wired text-indigo-600 text-2xl"></i>
                <span class="font-bold text-xl">VIOLET NET</span>
            </a>
            <div class="flex gap-4">
                <a href="{{ route('login') }}" class="px-6 py-2 text-indigo-600 font-semibold">Masuk</a>
                <a href="{{ route('register') }}" class="px-6 py-2 bg-indigo-600 text-white rounded-full font-bold">Daftar</a>
            </div>
        </div>
    </nav>

    <div class="pt-20">
        @yield('content')
    </div>

    <footer class="bg-gray-900 text-white py-10 mt-20">
        <div class="text-center text-sm text-gray-500">
            &copy; 2025 Violet Network Sumenep.
        </div>
    </footer>
</body>
</html>