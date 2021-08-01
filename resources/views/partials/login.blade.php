<div id="login_popup" class="popup_wrapper1">
    <div class="popup_wrapper2">
        <div id="login_wrapper" class="flex popup_content" style="width: 700px;">
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
                        <h3>התחברות</h3>
                        <p style="color:#999999">הזן את הפרטים</p>
                    </div>

                    <form id="login_form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">כתובת מייל</label>

                            <div>
                                <input id="login_email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">סיסמה</label>

                            <div>
                                <input id="login_password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group text-left">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    שכחתי סיסמה
                                </a>
                            @endif
                        </div>


                        <div class="form-group">
                            <div>
                                <button type="submit" id="login_submit" class="btn">
                                    התחבר
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <p class="flex center_content">לא רשום?
                                <a class="nav-link" onclick="switchPopup('login_popup','register_popup')" href="javascript:void(0)" type="button">
                                    להרשמה
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
    #login_form a {
        color: #ff7100;
        text-decoration: none;
    }

    #login_form a:hover {
        color: #ff7100;
        text-decoration: none;
        cursor: pointer;
    }

    #login_form #login_submit {
        background-color: #ff7100;
        width: 100%;
        color: #fff;
    }

</style>
