<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @hasSection('title')
    <title>U.F.O. Špačince | @yield('title')</title>
    @else
    <title>U.F.O. Špačince</title>
    @endif
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/images/web/favicon.png">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="container p-0">
    <div id="app">
        <!-- NAV MENU  -->
        @include('layouts._nav')
        <!-- MAIN CONTAINER  -->
        <section class="row h-100 mb-5">
            <!-- SIDE PANEL  -->
            <aside class="col-2 border-end">
                @include('layouts._aside')
            </aside>
            <!-- MAIN CONTENT  -->
            <main class="col-10 py-4 px-2 h-100">
                @include('layouts._messages')
                @yield('content')
            </main>
        </section>
        <!-- FOOTER  -->
        <footer class="row fixed-bottom">
            <section class="col-12 text-center">
                U.F.O. Špačince {{ Date('Y') }}
            </section>
        </footer>
    </div>
</body>

</html>