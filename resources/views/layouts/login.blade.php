<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>    
    <link rel="shortcut icon" href="{{ asset('public/images/logo_rounded.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('public/css/icheck-bootstrap.min.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('public/css/all.min.css') }}">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition login-page">
    @yield('content')
    <p class="powered-text">powered by
        <a href="https://froztech.com" target="_blank" class="text-dark">
            <img src="{{ asset('public/images/froztech_dark.png') }}" alt="froztech" class="froztech-logo">
        </a>
    </p>

</body>
</html>
