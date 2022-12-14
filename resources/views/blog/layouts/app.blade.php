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
    @include('blog.layouts.top-navbar')

    @if (isset($header))
        <header class="w-full container mx-auto">
            <div class="flex flex-col items-center py-12">
                <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="#">
                    {{ __('Minimal Blog') }}
                </a>
                <p class="text-lg text-gray-600">
                    {{ $header }}
                </p>
            </div>
        </header>
    @endif
    @include('blog.layouts.category-navbar')

    <main>
        {{ $slot }}
    </main>

    @include('blog.layouts.footer')
    @livewireScripts
</body>

</html>
