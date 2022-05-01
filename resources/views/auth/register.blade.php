<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script defer src="{{ mix('js/app.js') }}"></script>
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
<?php
$countries = App\Models\Country::all()->toArray();
$avatars = App\Models\Avatar::all()->toArray();
?>

<div id="registration_area">
    <div id="app">
    <div id="registration_container">
        <div id="registration_title"><span>Register a new account</span></div>
        <div id="registration_form_container">
            <div id="registration_form">
                <!-- form -->
                <form method="POST" action="{{ route('register') }}" autocomplete="off" style="height: 270px;">
                    @csrf
                    <input type="hidden" id="rooting" name="rooting" required>
                    <input type="hidden" id="avatar" name="avatar" required>
                    <div id="registration_form_body">
                        <div id="input_user_container">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="username" value="{{ old('name') }}" required autocomplete="false">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                             </span>
                            @enderror
                        </div>

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

                        <div id="input_pass_container">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="confirm password" required autocomplete="new-password">
                        </div>

                        <div><button type="submit" id="submit">register</button></div>

                    </div>
                </form>
                <!-- end form -->
                <div id="or_sign_in" style="margin-top: 12px">------- or sign in with -------</div>
                <div id="login__socials">
                    <a href="#"><img style="margin-right: 10px" src="{{ asset('images/login__google.png') }}" alt="sign in with Google"></a>
                    <a href="#"><img src="{{ asset('images/login__fb.png') }}" alt="sign in with Facebook"></a>
                </div>
            </div>
            <div id="registration_team_and_avatar">
                <country-list :countries="{{ json_encode($countries) }}" :avatars="{{ json_encode($avatars) }}"></country-list>
            </div>
        </div>
    </div>
    <div id="registration_bg_pic"></div>
</div>
</div>
</body>
</html>
