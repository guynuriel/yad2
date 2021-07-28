@extends('layouts.yad2')

@section('content')

    <div id="register_wrapper" class="flex center" style="width: 700px;">
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
                    <h3>הרשמה</h3>
                    <p style="color:#999999">הזן את הפרטים</p>
                </div>

                <form id="registerForm" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="nameInput">שם</label>

                        <div>
                            <input id="nameInput" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                autocomplete="name" autofocus>

                            <span class="invalid-feedback" role="alert" id="nameError">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="emailInput">כתובת מייל</label>

                        <div class="">
                            <input id="emailInput" type="email" class="form-control" name="email"
                                value="{{ old('email') }}" required autocomplete="email">

                            <span class="invalid-feedback" role="alert" id="emailError">
                                <strong></strong>
                            </span>
                        </div>
                    </div>




                    <div class="form-group ">
                        <label for="passwordInput">סיסמה</label>
                        <div>
                            <input id="passwordInput" type="password" class="form-control" name="password" required
                                autocomplete="new-password">

                            <span class="invalid-feedback" role="alert" id="passwordError">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="password-confirm">אמת סיסמה</label>

                        <div>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn">
                                הרשם
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="flex center_content">כבר רשום?
                            <a class="nav-link pointer" type="button" href="/login">
                                להתחברות
                            </a>
                        </p>
                    </div>
                </form>

            </div>




        </div>
    </div>









    <style>
        #registerForm a {
            color: #ff7100;
            text-decoration: none;
        }

        #registerForm a:hover {
            color: #ff7100;
            text-decoration: none;
            cursor: pointer;
        }

        #registerForm button {
            background-color: #ff7100;
            width: 100%;
            color: #fff;
        }

    </style>



    <script>
        $(function() {
            $('#registerForm').submit(function(e) {
                e.preventDefault();
                let formData = $(this).serializeArray();
                $(".invalid-feedback").children("strong").text("");
                $("#registerForm input").removeClass("is-invalid");
                $.ajax({
                    method: "POST",
                    headers: {
                        Accept: "application/json"
                    },
                    url: "{{ route('register') }}",
                    data: formData,
                    success: () => window.location.assign("{{ route('index') }}"),
                    error: (response) => {
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            Object.keys(errors).forEach(function(key) {
                                $("#" + key + "Input").addClass("is-invalid");
                                $("#" + key + "Error").children("strong").text(errors[
                                    key][0]);
                            });
                        } else {
                            window.location.reload();
                        }
                    }
                })
            });
        })
    </script>


