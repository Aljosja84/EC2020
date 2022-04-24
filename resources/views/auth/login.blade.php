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
                <form method="POST" action="{{ route('login') }}" autocomplete="off">
                    @csrf
                    <div id="form_body">
                        <div id="input_email_container">
                            <input id="email" type="email" name="email" placeholder="email" value="{{ old('email') }}" required autocomplete="false">


                            <span class="invalid-feedback" role="alert">
                                @error('email')<strong>{{ $message }}</strong> @enderror
                            </span>
                        </div>

                        <div id="input_pass_container">
                            <input id="password" type="password" placeholder="password" name="password" required autocomplete="chrome-off">

                            <span class="invalid-feedback" role="alert">
                                 @error('password')<strong>{{ $message }}</strong>@enderror
                            </span>
                        </div>

                        <div><button type="submit" id="submit">sign in</button></div>
                        <div id="remember">
                            <span><input type="checkbox" id="scales" name="scales" style="margin-right: .4rem; vertical-align: middle"><label for="scales">Remember me</label></span>
                            <span>Forgot password?</span>

                        </div>
                    </div>
                </form>
            </div>
            <!-- background pic -->
            <div id="bg_log_win"></div>
        </div>
    </div>
<div id="bg_pic"></div>
</body>
</html>
