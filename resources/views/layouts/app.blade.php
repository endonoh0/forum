<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
            window.App = {!! json_encode([
                'user' => Auth::user(),
                'signedIn' => Auth::check()
            ]) !!};
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">

    <style>
        body { padding-bottom: 100px; }
         .level { display: flex; align-items: center; }
         .flex-only { display: flex }
         .level-item { margin-right: 1em; }
         .flex { flex: 1; }
         .mr-1 { margin-right: 1em; }
         .ml-a { margin-left: auto; }
         [v-cloak] { display: none; }
         .ais-highlight > em { background: yellow; font-style: normal; }
    </style>

    @yield('header')
</head>
<body>
<div id="app">
    @include ('layouts.nav')

    <main class="py-4">
        @yield('content')

        <flash message="{{ session('flash') }}"></flash>
    </main>

</div>
</body>
</html>
