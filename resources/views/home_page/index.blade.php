@extends('layouts.yad2')

@section('content')
    <link href="{{ asset('css/home_page.css') }}" rel="stylesheet">

    @include('home_page.sections.search')
    <section class="flex">
        <div class="feed_items">
            
            @include('home_page.sections.feed')
           
        </div>
    </section>
    <div id="ajax-load" class="text-center m-4" style="display: none" >
        <p>
            Loading More Post
            <img width="50px" src="{{ asset('images/web-imgs/loading.gif') }}">
        </p>
    </div>
    @include('home_page.sections.images_popup')
    
    
@endsection
