<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.4, shrink-to-fit=no" />
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Darmon.ru</title>
    
    <!-- Favicons -->
    <link rel="shortcut icon" href="/img/favicon.ico">

    <link href="/lib/normalize-8.0.1.css" rel="stylesheet">
    <link href="/lib/bootstrap-4.3.1.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->
    
    @include('header')
    @yield('content')
    @include('footer')

    <!-- Scripts -->
    <script src="/lib/jquery-3.4.1.min.js"></script>
    <script src="/lib/popper-1.14.6.min.js"></script>
    <script src="/lib/bootstrap-4.3.1.min.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>