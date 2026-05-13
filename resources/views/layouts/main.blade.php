<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<nav class="p-4 bg-white shadow mb-6">
    <div class="container mx-auto">
        <h1 class="font-bold">My Laravel App</h1>
    </div>
</nav>

<div class="container mx-auto px-4">
    @yield('content') <!-- This is where your post list will appear -->
</div>

</body>
</html>
