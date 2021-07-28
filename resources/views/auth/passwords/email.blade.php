@extends('layouts.yad2')

@section('content')
    <div id="login_wrapper" class="flex center" style="width: 700px;">
        <div style="width: 250px;background: linear-gradient(229.5deg,#fa0,#ff7100);padding: 30px;">
            <div>
                <img width="100" src="{{ asset('images/logos/yad2Logo.png') }}">
            </div>
            <h1 style="color: #fff">ברוכים הבאים לאתר יד2</h1>
            <p style="color: #fff">טוב לראות אותך שוב!</p>
            <div class="center_content"><img width="150" src="{{ asset('images/web-imgs/couch_lamp.svg') }}" alt="">
            </div>
        </div>
        <div class="center_content" style="width: 450px; background-color:#fff;position: relative;">
            <div style="width: 300px;">


                <div>
                    <h3>איפוס סיסמה</h3>
                    <p style="color:#999999">הזן את הפרטים</p>
                </div>

                <form method="POST" id="resertForm" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">{{ __('כתובת מייל') }}</label>

                        <div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <div >
                            <button class="btn" type="submit" >
                                {{ __('אפס סיסמה') }}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <style>
        #resertForm a {
            color: #ff7100;
            text-decoration: none;
        }

        #resertForm a:hover {
            color: #ff7100;
            text-decoration: none;
            cursor: pointer;
        }

        #resertForm button {
            background-color: #ff7100;
            width: 100%;
            color: #fff;
        }

    </style>

@endsection
