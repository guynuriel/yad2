<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logos/yad2Logo.png') }}" />
    <title>Yad2</title>

    <!-- Scripts -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    @if (($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/favorites') || request('search'))
    <script src="{{ asset('js/home_page/index.js') }}" defer></script>
    @endif

    <!-- Fonts -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">

    {{-- / --}}
    @if (($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/favorites') || request('search'))
        <link href="{{ asset('css/home_page.css') }}" rel="stylesheet">
    @endif

    @if ($_SERVER['REQUEST_URI'] === '/ads/create')
        <link href="{{ asset('css/create.css') }}" rel="stylesheet">
    @endif

</head>

<body>

    @include('layouts.sections.navbar')

    @yield('content')




    @include('partials.login')
    @include('partials.register')




    @if ($_SERVER['REQUEST_URI'] === '/' || request('search'))

    <script type="text/javascript" src="{{ asset('js/home_page/search.js') }}" defer></script>
    <script type="text/javascript" type="module" src="{{ asset('js/home_page/swiper.js') }}" defer></script>



    @elseif ($_SERVER['REQUEST_URI'] === '/ads/create')
    <script src="{{ asset('js/create.js') }}" defer></script>
    <script src="{{ asset('js/cities_addresses_data/addressesArray.js') }}" defer></script>
    @endif


    <script type="text/javascript" src="{{ asset('js/cities_addresses_data/citiesArray.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/cities_addresses_data/logic.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/login_register.js') }}" defer></script>


    @if ($errors->has('email') || $errors->has('password'))

    <script>
        $(document).ready(function() {

                if (sessionStorage.getItem("form") === 'login_popup')
                    showPopup("login_popup")

                else if (sessionStorage.getItem("form") === 'register_popup')
                    showPopup("register_popup")
            })
    </script>
    @endif
</body>

</html>