<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Scripts -->
    @if ($_SERVER['REQUEST_URI'] === '/' )
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
    @if ($_SERVER['REQUEST_URI'] === '/' )
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    @elseif ($_SERVER['REQUEST_URI'] === '/ads/create')    
        <link href="{{ asset('css/create.css') }}" rel="stylesheet">
    @endif

</head>

<body class="antialiased">
   <!-- Scripts -->
   
    
    @include('layouts.sections.navbar')
    @yield('content')
    
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    
    
    @if ($_SERVER['REQUEST_URI'] === '/' )
    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/home_page/search.js') }}" defer></script>
    <script type="text/javascript" type="module" src="{{ asset('js/home_page/swiper.js') }}" defer></script>
        


    @elseif ($_SERVER['REQUEST_URI'] === '/ads/create')    
    <script src="{{ asset('js/create.js') }}" defer></script>
    <script src="{{ asset('js/cities_addresses_data/addressesArray.js') }}" defer></script>
    @endif


    <script type="text/javascript" src="{{ asset('js/cities_addresses_data/citiesArray.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/cities_addresses_data/logic.js') }}" defer></script>
    
    <script>
        $(".sidenav_toggle" ).click(function(e){  
            e.stopPropagation();
            $( "#sidenav_wrapper" ).toggle( "slide" );
        })
    </script>


@if ($_SERVER['REQUEST_URI'] === '/' )
    <script>   

        // -------   pagination

        function infiniteScrollPagination (page){

            $.ajax({
                url: '?page=' + page,
                type: 'GET',
                beforeSend: function(){
                    $('#ajax-load').show();
                },
                success: function(ads){
                    if(ads.html == ""){
                        $('#ajax-load').html("אין מודעות נוספות");
                        return;
                    }
                    setTimeout(function() { 
                        $('#ajax-load').hide();
                    }, 2000);
                    $('.feed_items').append(ads.html);
                    if($(window).width() > 880){
                        $('.mobile_ad_wrapper').remove()
                    }else{
                        $('.single-ad-wrapper').remove()
                    }

                },
                error:function(jqXHR){
                    alert("טעינת מודעות נוספות נכשלה")
                },
                complete: function(){
                    
                }
            })
        }

        let page = 1;
        $(window).scroll(function(){
            if($(window).scrollTop() + $(window).height() == $(document).height()){
                page++;
                infiniteScrollPagination(page);
               
            }
        })

        // -------- popupimages funcs
        function get_images(e){
            e.stopPropagation();
            let id = e.target.getAttribute('ad_id')
            
            $.ajax({
                url:'http://127.0.0.1:8000/ajax/popupimgs',
                type: "GET",
                data:{
                    id: id
                },
                success: function(res){
                    let src;

                    if(res.result){
                        // for(let i = 0 ; i < res.result.length ; i++){
                        //     src = res.result[i];
                        //     let num = i+1;
                        //     if(src[15] === 'v')
                        //         $(".swiper-wrapper").append('<div class="swiper-slide">  <video class="swiper_video" controls><source src="'+ src +'" type="video/mp4"> </video> <p>תמונה '+ num +' מתוך ' + res.result.length+ '</p> </div> ')
                        //     else
                        //         $(".swiper-wrapper").append(' <div class="swiper-slide"> <img src=" '+ src +' " alt=""> <p>תמונה '+ num +' מתוך ' + res.result.length+ '</p> </div> ')
                        // }
                        $("#images_popup").toggle();
                    }
                }
            });
            

    
        }
        $(".pic .num_of_imgs").click(function(e){  
            get_images(e);
        })
        $(".popup_images").click(function(e){   
            get_images(e);
        })
        $( "#container" ).click(function(e) {
            e.stopPropagation();
        });

        $( "#images_popup" ).click(function() {
            $( "#images_popup" ).hide();
            $(".swiper-wrapper").empty();
            $(".swiper-wrapper").removeAttr( 'style' );
            $(".swiper-wrapper").attr('style', 'transition-duration: 0ms;');
            

        });
    </script>
@endif

</body>

</html>
