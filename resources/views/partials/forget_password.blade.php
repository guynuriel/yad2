<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div style="margin-top: calc(50vh - 250px);" class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="login_wrapper" class="flex" style="width: 700px;">
                <div style="width: 250px;background: linear-gradient(229.5deg,#fa0,#ff7100);padding: 30px;">
                    <div>
                        <img width="100" src="{{ asset('images/logos/yad2Logo.png') }}">
                    </div>
                    <h1 style="color: #fff">ברוכים הבאים לאתר יד2</h1>
                    <p style="color: #fff">טוב לראות אותך שוב!</p>
                    <div class="center_content"><img width="150" src="{{ asset('images/web-imgs/couch_lamp.svg') }}"
                            alt="">
                    </div>
                </div>
                <div class="center_content" style="width: 450px; background-color:#fff;position: relative;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="position: absolute;top:20px;left:20px;cursor: pointer;font-size:20px"><strong>X</strong></button>
                    <div style="width: 300px;">


                        <div>
                            <h3>איפוס סיסמה</h3>
                            <p style="color:#999999">הזן את הפרטים</p>
                        </div>

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






@section('scripts')
@parent

@if($errors->has('email') || $errors->has('password'))
    <script>
    $(function() {
        $('#loginModal').modal({
            show: true
        });
    });
    </script>
@endif
@endsection






<style>
    #login_form a {
        color: #ff7100;
        text-decoration: none;
    }

    #login_form a:hover {
        color:#ff7100; 
        text-decoration:none; 
        cursor:pointer;  
    }

    #login_form button {
        background-color: #ff7100;
        width: 100%;
        color: #fff;
    }

    
</style>
@extends('layouts.yad2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
