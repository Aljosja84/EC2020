<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mapbox related
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
    -->
    <link href="css/topmenu.css?v={{ time() }}" rel="stylesheet">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Roboto', sans-serif;
            font-weight: 200;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }


        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <div class="topmenu">
            <!-- EURO 2020 LOGO -->
            <div style="float: left">
                <img class="logo" src="images/logo_euro2020.png">
            </div>
            <!-------------------->

            <div style="background-color: #ffffff; height: 100%">
                <ul class="menu-main">
                    <li><a href="#">Stadiums</a><img src="images/arrow-drop-down.svg">
                        <div class="menu-sub-stadium">
                            <ul>
                                <li id="stadium"><a href="#">Amsterdam</a></li>
                                <li id="stadium"><a href="#">Amsterdam</a></li>
                                <li><a href="#">Amsterdam</a></li>
                                <li><a href="#">Amsterdam</a></li>
                            </ul>
                        </div>
                    <li><a href="#">Groups</a></li>
                    <li><a href="#">Teams</a></li>
                    <li><a href="#">Games</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!--
<div id='map_background' style="height:100%; width:100%; position: absolute; z-index: 0"></div>
-->

</body>
<!-- mapbox background
<script src="js/mapbox.js"></script>
-->
</html>
