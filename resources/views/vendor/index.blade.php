<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ config('app.name') }}@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
</head>
<body>
    <div id="wrapper" class="container">
        @section('content')

        @show
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>