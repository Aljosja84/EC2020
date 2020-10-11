<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />

    <link href="css/topmenu.css?v={{ time() }}" rel="stylesheet">

    <title>Euro 2020</title>

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

            <div class="container">
                <ul class="menu-main">

                    <li id="sub_item_stadium"><a id="main_link" href="#">Stadiums</a><img src="images/arrow-drop-down.svg">
                        <div class="menu_sub_stadium">
                            <ul>
                                @foreach(App\Models\Stadium::orderBy('city', 'asc')->get() as $stadium)
                                    <li id="stadium">
                                        <div class="stadium_link" id="{{ $stadium->abv }}">
                                            <p><img src="images/{{ $stadium->url_menu }}"></p>
                                            <p>{{ $stadium->city }}</p>
                                            <p>{{ $stadium->name }}</p>
                                            <p>seats {{ $stadium->capacity }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>

                    <li id="sub_item_groups"><a id="main_link" href="#">Groups</a><img src="images/arrow-drop-down.svg">
                        <div class="menu_sub_groups">
                            <ul>
                                @foreach(App\Models\Group::orderBy('name', 'asc')->get() as $group)
                                <li id="group">
                                    <div class="group_link">
                                        <a href="#">group {{ $group->name }}</a><img src="images/arrow-drop-down.svg" style="float: right">
                                    </div>
                                    <div class="group_sub">
                                        <div class="group_sub_wrapper">
                                            @foreach($group->countries as $country)
                                                <p><img src="images/country_flags/{{ $country->flag_url }}"/>{{ $country->name }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>

                    <li id="sub_item_teams"><a id="main_link" href="#">Teams</a><img src="images/arrow-drop-down.svg">
                        <div class="menu_sub_teams">
                            <ul>
                                <li id="team">
                                    <div class="team_link">
                                        <a href="#">Dit is groter dan ons allemaal</a>
                                    </div>
                                </li>
                                <li id="team">
                                    <div class="team_link">
                                        <a href="#">Dit is groter dan ons allemaal</a>
                                    </div>
                                </li>
                                <li id="team">
                                    <div class="team_link">
                                        <a href="#">Dit is groter dan ons allemaal</a>
                                    </div>
                                </li>
                                <li id="team">
                                    <div class="team_link">
                                        <a href="#">Dit is groter dan ons allemaal</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li id="sub_item_games"><a id="main_link" href="#">Games</a><img src="images/arrow-drop-down.svg">
                        <div class="menu_sub_games">
                            <ul>
                                <li id="game">
                                    <div class="game_link">
                                        <a href="#">Dit is groter dan ons allemaal</a>
                                    </div>
                                </li>
                                <li id="game">
                                    <div class="game_link">
                                        <a href="#">Dit is groter dan ons allemaal</a>
                                    </div>
                                </li>
                                <li id="game">
                                    <div class="game_link">
                                        <a href="#">Dit is groter dan ons allemaal</a>
                                    </div>
                                </li>
                                <li id="game">
                                    <div class="game_link">
                                        <a href="#">Dit is groter dan ons allemaal</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div id='map_background'></div>

</body>

<script src="js/mapbox.js"></script>

</html>
