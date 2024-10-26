<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('img/favicon.ico') }}" />
    @include('layouts.includes.stylesheet')

</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('layouts.includes.header')

            @yield('content')

            @include('layouts.includes.footer')

        </div>
    </div>

    @include('layouts.includes.js')
    @include('components.toast-notifications')

</body>

</html>
