<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/super-build/ckeditor.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/virtual-select-plugin@1.0.39/dist/virtual-select.min.js"
        integrity="sha256-Gsn2XyJGdUeHy0r4gaP1mJy1JkLiIWY6g6hJhV5UrIw=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/virtual-select-plugin@1.0.39/dist/virtual-select.min.css"
        integrity="sha256-KqTuc/vUgQsb5EMyyxWf62qYinMUXDpWELyNx+cCUr0=" crossorigin="anonymous">
</head>

<body class="font-Karla antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    @stack('scripts')
</body>

</html>
