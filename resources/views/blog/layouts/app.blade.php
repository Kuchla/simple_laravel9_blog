<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Blog') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-white font-karla">
    <header>
        @include('blog.layouts.top-navbar')
        @include('blog.layouts.category-navbar')
    </header>

    <main>
        {{ $slot }}
    </main>

    @include('blog.layouts.footer')
    @livewireScripts
</body>

</html>
