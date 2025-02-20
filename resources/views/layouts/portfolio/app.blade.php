<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $user->name ? $user->name : 'Name' }} | {{ config('app.name') }} - @yield('title')</title>

    {{-- astro boilerplate --}}
    <meta name="description" content="Boilerplate built with Astro using React and Tailwind CSS">
    <meta name="author" content="Emma">
    <link rel="alternate" type="application/rss+xml" href="{{ asset('/') }}astro-boilerplate/rss.xml">
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('/') }}astro-boilerplate/favicon.ico"> --}}
    <link rel="stylesheet" href="{{ asset('/') }}astro-boilerplate/_astro/index.CvLV1VIh.css" />
    {{-- enf astro boilerplate --}}

    <link rel="stylesheet" href="{{ asset('/') }}fancybox/jquery.fancybox.min.css" />

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @yield('styles')
    @vite('resources/css/app.css')
</head>

<body class="antialiased bg-slate-900 text-gray-100 flex flex-col min-h-screen">
    <div class="w-full">
        @include('layouts.portfolio.navbar')
    </div>

    <main class="flex-grow">
        @yield('content')
    </main>

    <div class="w-full">
        @include('layouts.portfolio.footer')
    </div>

    <script src="{{ asset('/') }}jquery/jquery.min.js"></script>
    <script src="{{ asset('/') }}fancybox/jquery.fancybox.min.js"></script>
    <script src="{{ asset('/') }}sweetalert2/sweetalert2.js"></script>

    <script>
        $(document).ready(function() {
            $('[data-fancybox="gallery"]').fancybox();
        });
    </script>

    @vite('resources/js/app.js')
    @yield('scripts')
</body>

</html>
