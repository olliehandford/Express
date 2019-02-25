<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @if (Auth::check())
            <script>
                window.Laravel = { csrfToken: '{{ csrf_token() }}'}
                var api_token  = "{{ Auth::user()->api_token }}"
            </script>
        @endif

        <title>{{ config('app.name', 'Express Notify') }}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        @include('inc.navbar')
        <div class="container">
            @include('partials.notice')

            @yield('content') 
        </div>
        <script src="https://js.stripe.com/v2/"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="{{ asset('js/stripe.js') }}"></script>
    </body>
</html>
