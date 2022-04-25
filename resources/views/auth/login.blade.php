<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ec2020.css') }}" rel="stylesheet">
</head>
<body>
<div class="top_bar">
    <!-- EURO 2020 LOGO -->
    <div style="float: left">
        <img class="logo" src={{ asset('images/logo_euro2020.png') }} style="margin-left: 5px">
    </div>
</div>
    <div id="login_area">
        <div id="login_window">
            <!-- window title -->
            <div id="window_title">Please login to use all features of this website</div>
            <!-- login -->
            <div id="login_win_fields">
                <div id="tri"></div>
                <div id="login_ava"></div>
                <div id="sign_in">Sign in</div>
            <!-- form -->
                <form method="POST" action="{{ route('login') }}" autocomplete="off" style="height: 270px;">
                    @csrf
                    <div id="form_body">
                        <div id="input_email_container">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="email" value="{{ old('email') }}" required autocomplete="false">


                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div id="input_pass_container">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" name="password" required autocomplete="chrome-off">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div><button type="submit" id="submit">sign in</button></div>
                        <div id="remember_me">
                            <span><input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="margin-right: .3rem; vertical-align: middle" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><label for="remember">Remember me</label></span>
                            <span><a href="{{ route('password.request') }}">Forgot password?</a></span>
                        </div>
                    </div>
                </form>
                <div id="or_sign_in">------- or sign in with -------</div>
                <div id="login__socials">
                    <a href="#"><img style="margin-right: 10px" src="{{ asset('images/login__google.png') }}" alt="sign in with Google"></a>
                    <a href="#"><img src="{{ asset('images/login__fb.png') }}" alt="sign in with Facebook"></a>
                </div>
            </div>
            <!-- background pic -->
            <div id="bg_log_win"></div>
        </div>
    </div>
<div id="bg_pic"></div>
</body>
</html>
