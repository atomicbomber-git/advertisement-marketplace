<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1"
    >

    <!-- CSRF Token -->
    <meta name="csrf-token"
          content="{{ csrf_token() }}"
    >

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"
            defer
    ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch"
          href="//fonts.gstatic.com"
    >
    <link href="https://fonts.googleapis.com/css?family=Nunito"
          rel="stylesheet"
    >

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}"
          rel="stylesheet"
    >

    @livewireStyles
</head>
<body>
<header>
    @include('components.navbar')
</header>

<main class="container py-4">
    <section class="section columns">
        @auth
            @include('components.sidebar')
        @endauth

        <article class="column">
            @yield("content")
        </article>
    </section>
</main>

@livewireScripts
</body>
</html>
