<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logos/yad2Logo.png') }}"/>
    <title>Yad2</title>

    <!-- Scripts -->
    @if ($_SERVER['REQUEST_URI'] === '/' || request('search'))
        <script src="{{ asset('js/home.js') }}" defer></script>
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
    @if ($_SERVER['REQUEST_URI'] === '/ads/create')
        <link href="{{ asset('css/create.css') }}" rel="stylesheet">
    @endif

</head>

<body class="antialiased">
    <!-- Scripts -->

    @include('layouts.sections.navbar')
    @yield('content')




    @include('partials.login')
    @include('partials.register')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>


    @if ($_SERVER['REQUEST_URI'] === '/'  || request('search'))

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

    <script>
        $(".sidenav_toggle").click(function(e) {
            e.stopPropagation();
            $("#sidenav_wrapper").toggle("slide");
        })
    </script>



    @if ($_SERVER['REQUEST_URI'] === '/' || request('search'))
        <script>
            var isMoreAds = true;
            // -------   pagination
            function infiniteScrollPagination(page) {
                if (window.isMoreAds) {

                    // check if exists params in the url and add them to the ajax
                    let urlSearchParams = new URLSearchParams(window.location.search);
                    let params = Object.fromEntries(urlSearchParams.entries());
                    let url = '?page=' + page;
                    if (params) {
                        for (let key in params) {
                            if (params.hasOwnProperty(key)&& params[key]!='' ) {
                                url += "&" + key + "=" + params[key];
                            }
                        }
                    }
                    $.ajax({
                        url: url,
                        type: 'GET',
                        beforeSend: function() {
                            $('#ajax-load').show();
                        },
                        success: function(ads) {
                            if (ads.html == "") {
                                $('#ajax-load').html("אין מודעות נוספות");
                                $('#ajax-load').css("display", "block");
                                window.isMoreAds = false;
                                return;
                            }
                            setTimeout(function() {
                                $('#ajax-load').hide();
                            }, 2000);
                            $('.feed_items').append(ads.html);
                            if ($(window).width() > 880) {
                                $('.mobile_ad_wrapper').remove()
                            } else {
                                $('.single-ad-wrapper').remove()
                            }

                        },
                        error: function(jqXHR) {
                            $('#ajax-load').html("טעינת מודעות נוספות נכשלה")
                        },
                        complete: function() {

                        }
                    })

                } else {
                    $('#ajax-load').css("display", "block");
                }
            }

            var page = 1;

            $(window).scroll(function() {
                if (($(window).scrollTop() + $(window).height()) >= $(document).height()) {
                    page++;
                    infiniteScrollPagination(page);

                }
            })

            // -------- popupimages funcs
            function get_images(e) {
                e.stopPropagation();
                let id = e.target.getAttribute('ad_id')
                console.log(id)
                
                $.ajax({
                    url: 'http://127.0.0.1:8000/ajax/popupimgs',
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(res) {
                        let src;
                        if (res.result) {
                            for(let i = 0 ; i < res.result.length ; i++){
                                src = res.result[i];
                                let num = i+1;
                                if(src[15] === 'v')
                                    $(".slideshow-container").append(' <div class="mySlides"><video class="swiper_video" controls><source src="'+ src +'" type="video/mp4"> </video><div class="numbertext fade">תמונה '+ num +' מתוך ' + res.result.length+ '</div></div>')
                                else
                                    $(".slideshow-container").append(' <div class="mySlides"><img src="'+ src +'"><div class="numbertext fade">תמונה '+ num +' מתוך ' + res.result.length+ '</div></div>')
                            }
                            
                            window.showSlides(1);
                            $("#images_popup").toggle();
                        }

                    },
                    error: function(jqXHR) {
                        alert("טעינת תמונות נכשלה")
                    },
                    complete: function() {

                    }
                })
            }
            $(".pic .num_of_imgs").click(function(e) {
                get_images(e);
            })
            $(".popup_images").click(function(e) {
                console.log('ss')
                get_images(e);
            })
            $("#container").click(function(e) {
                e.stopPropagation();
            });
            $(".carousel-control-prev-icon").click(function(e) {
                e.stopPropagation();
            });

            $("#images_popup").click(function() {
                $("#images_popup").hide();
                $(".slideshow-container").empty();
                $(".slideshow-container").html('<a class="prev" onclick="plusSlides(-1)">&#10094;</a><a class="next" onclick="plusSlides(1)">&#10095;</a>');
            });
        </script>
    @endif


</body>

</html>
