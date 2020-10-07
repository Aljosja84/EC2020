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
                                <li id="stadium">
                                    <div class="stadium_link" id="AMS">
                                        <p><img src="images/Amsterdam_Stadium_Menu.png"></p>
                                        <p>Amsterdam</p>
                                        <p>Johan Cruyff Arena</p>
                                        <p>seats 55.500</p>
                                    </div>
                                </li>
                                <li id="stadium">
                                    <div class="stadium_link" id="BAK">
                                        <p><img src="images/Baku_Stadium_Menu.png"></p>
                                        <p>Baku</p>
                                        <p>Olympic Stadium</p>
                                        <p>seats 68.700</p>
                                    </div>
                                </li>
                                <li id="stadium">
                                    <div class="stadium_link" id="BIL">
                                        <p><img src="images/Bilboa_Stadium_Menu.png"></p>
                                        <p>Bilboa</p>
                                        <p>San Mamés Stadium</p>
                                        <p>seats 53.289</p>
                                    </div>
                                </li>
                                <li id="stadium">
                                    <div class="stadium_link" id="BRU">
                                        <p><img src="images/Brussels_Stadium_Menu.png"></p>
                                        <p>Brussels</p>
                                        <p>Eurostadium</p>
                                        <p>seats 62.613</p>
                                    </div>
                                </li>
                                <li id="stadium">
                                    <div class="stadium_link" id="BUC">
                                        <p><img src="images/Bucharest_Stadium_Menu.png"></p>
                                        <p>Bucharest</p>
                                        <p>National Arena</p>
                                        <p>seats 55.634</p>
                                    </div>
                                </li>
                                <li id="stadium">
                                    <div class="stadium_link" id="BUD">
                                        <p><img src="images/Budapest_Stadium_Menu.png"></p>
                                        <p>Budapest</p>
                                        <p>Puskás Ferenc Stadion</p>
                                        <p>seats 38.652</p>
                                    </div>
                                </li>
                                <li id="stadium">
                                    <div class="stadium_link" id="COP">
                                        <p><img src="images/Copenhagen_Stadium_Menu.png"></p>
                                        <p>Copenhagen</p>
                                        <p>Parken Stadium</p>
                                        <p>seats 38.065</p>
                                    </div>
                                </li>
                                <li id="stadium">
                                    <div class="stadium_link" id="DUB">
                                        <p><img src="images/Dublin_Stadium_Menu.png"></p>
                                        <p>Dublin</p>
                                        <p>Aviva Stadium</p>
                                        <p>seats 51.700</p>
                                    </div>
                                </li>
                                <li id="stadium">
                                    <div class="stadium_link" id="GLA">
                                        <p><img src="images/Glasgow_Stadium_Menu.png"></p>
                                        <p>Glasgow</p>
                                        <p>Hampden Park</p>
                                        <p>seats 51.866</p>
                                    </div>
                                </li>
                                <li id="stadium">
                                    <div class="stadium_link" id="MUN">
                                        <p><img src="images/Munich_Stadium_Menu.png"></p>
                                        <p>Munich</p>
                                        <p>Allianz Arena</p>
                                        <p>seats 75.024</p>
                                    </div>
                                </li>
                                <li id="stadium">
                                    <div class="stadium_link" id="PET">
                                        <p><img src="images/Petersburg_Stadium_Menu.png"></p>
                                        <p>St. Petersburg</p>
                                        <p>Krestovsky Stadium</p>
                                        <p>seats 68.000</p>
                                    </div>
                                </li>
                                <li id="stadium">
                                    <div class="stadium_link" id="ROM">
                                        <p><img src="images/Rome_Stadium_Menu.png"></p>
                                        <p>Rome</p>
                                        <p>Stadio Olimpico</p>
                                        <p>seats 72.698</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li id="sub_item_groups"><a id="main_link" href="#">Groups</a><img src="images/arrow-drop-down.svg">
                        <div class="menu_sub_groups">
                            <ul>
                                <li id="group">
                                    <div class="group_link">
                                        <a href="#">Dit is groter dan ons allemaal</a>
                                    </div>
                                </li>
                                <li id="group">
                                    <div class="group_link">
                                        <a href="#">Dit is groter dan ons allemaal</a>
                                    </div>
                                </li>
                                <li id="group">
                                    <div class="group_link">
                                        <a href="#">Dit is groter dan ons allemaal</a>
                                    </div>
                                </li>
                                <li id="group">
                                    <div class="group_link">
                                        <a href="#">Dit is groter dan ons allemaal</a>
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
