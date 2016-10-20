<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ config('app.name') }}@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="wrapper" class="main">
        @include('components.header')

        <div class="container">
            @section('content')

            @show
        </div>

        @include('components.footer')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @if(Session::has('notificate'))
        @php
            $flash = Session::get('notificate')['flash'];
        @endphp
        <script>
            window.toastr['{{ $flash['level'] }}']('{{ $flash['message'] }}')
        </script>
    @endif
</body>
</html>