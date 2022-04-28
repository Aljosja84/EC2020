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
<div id="login_area">
<div id="app">
    <country-list :countries="{{ json_encode($countries) }}" :avatars="{{ json_encode($avatars) }}"></country-list>
</div>
</div>
</body>
</html>
