<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- Tailwind UI -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <!-- Alpine -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    @livewireStyles

    @stack('styles')

</head>

<body class="antialiased font-sans bg-gray-200">

    @yield('content')

    @livewireScripts

    @stack('scripts')

</body>

</html>
