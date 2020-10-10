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
                                <li id="group">
                                    <div class="group_link">
                                        <a href="#">group a</a><img src="images/arrow-drop-down.svg" style="float: right">
                                    </div>
                                    <div class="group_sub">
                                        <div class="group_sub_wrapper">
                                            <p><img src="images/country_flags/turkey.png"/>Turkey</p>
                                            <p><img src="images/country_flags/italy.png"/>Italy</p>
                                            <p><img src="images/country_flags/wales.png"/>Wales</p>
                                            <p><img src="images/country_flags/switzerland.png"/>Switzerland</p>
                                        </div>
                                    </div>
                                </li>

                                <li id="group">
                                    <div class="group_link">
                                        <a href="#">group b</a><img src="images/arrow-drop-down.svg" style="float: right">
                                    </div>
                                    <div class="group_sub">
                                        <div class="group_sub_wrapper">
                                            <p><img src="images/country_flags/denmark.png"/>Denmark</p>
                                            <p><img src="images/country_flags/finland.png"/>Finland</p>
                                            <p><img src="images/country_flags/belgium.png"/>Belgium</p>
                                            <p><img src="images/country_flags/russia.png"/>Russia</p>
                                        </div>
                                    </div>
                                </li>

                                <li id="group">
                                    <div class="group_link">
                                        <a href="#">group c</a><img src="images/arrow-drop-down.svg" style="float: right">
                                    </div>
                                    <div class="group_sub">
                                        <div class="group_sub_wrapper">
                                            <p><img src="images/country_flags/netherlands.png"/>Netherlands</p>
                                            <p><img src="images/country_flags/ukraine.png"/>Ukraine</p>
                                            <p><img src="images/country_flags/austria.png"/>Austria</p>
                                            <p><img src="images/country_flags/qualifier.png"/>Play-off winner D</p>
                                        </div>
                                    </div>
                                </li>

                                <li id="group">
                                    <div class="group_link">
                                        <a href="#">group d</a><img src="images/arrow-drop-down.svg" style="float: right">
                                    </div>
                                    <div class="group_sub">
                                        <div class="group_sub_wrapper">
                                            <p><img src="images/country_flags/england.png"/>England</p>
                                            <p><img src="images/country_flags/croatia.png"/>Croatia</p>
                                            <p><img src="images/country_flags/qualifier.png"/>Play-off winner C</p>
                                            <p><img src="images/country_flags/czechrepublic.png"/>Czech Republic</p>
                                        </div>
                                    </div>
                                </li>

                                <li id="group">
                                    <div class="group_link">
                                        <a href="#">group e</a><img src="images/arrow-drop-down.svg" style="float: right">
                                    </div>
                                    <div class="group_sub">
                                        <div class="group_sub_wrapper">
                                            <p><img src="images/country_flags/spain.png"/>Spain</p>
                                            <p><img src="images/country_flags/sweden.png"/>Sweden</p>
                                            <p><img src="images/country_flags/poland.png"/>Poland</p>
                                            <p><img src="images/country_flags/qualifier.png"/>Play-off winner B</p>
                                        </div>
                                    </div>
                                </li>

                                <li id="group">
                                    <div class="group_link">
                                        <a href="#">group f</a><img src="images/arrow-drop-down.svg" style="float: right">
                                    </div>
                                    <div class="group_sub">
                                        <div class="group_sub_wrapper">
                                            <p><img src="images/country_flags/qualifier.png"/>Play-off winner A</p>
                                            <p><img src="images/country_flags/portugal.png"/>Portugal</p>
                                            <p><img src="images/country_flags/france.png"/>France</p>
                                            <p><img src="images/country_flags/germany.png"/>Germany</p>
                                        </div>
                                    </div>
                                </li>


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
