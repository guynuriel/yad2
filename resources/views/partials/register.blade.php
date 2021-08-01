<div id="register_popup" class="popup_wrapper1">
    <div class="popup_wrapper2">
        <div id="register_wrapper" class="flex popup_content" style="width: 700px;">
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
                <button class="hide_popup_btn close">X</button>
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
                                <input id="nameInput" type="text" class="form-control" name="name"
                                    value="{{ old('name') }}" autocomplete="name" autofocus>
                            </div>
                            @error('name')
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group ">
                            <label for="emailInput">כתובת מייל</label>

                            <div class="">
                                <input id="emailInput" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                        <div class="form-group ">
                            <label for="passwordInput">סיסמה</label>
                            <div>
                                <input id="passwordInput" type="password" class="form-control" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="password-confirm">אמת סיסמה</label>
                            <div>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                                @error('password')
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                <a class="nav-link" onclick="switchPopup('register_popup','login_popup')"
                                    href="javascript:void(0)" type="button">
                                    להתחברות
                                </a>
                            </p>
                        </div>
                    </form>

                </div>

            </div>
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
