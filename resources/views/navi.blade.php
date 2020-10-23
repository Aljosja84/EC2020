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
            background-color: lightblue;
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
                                @foreach(App\Models\Country::orderBy('name', 'asc')->get() as $country)
                                    <li id="team">
                                        <a href="#">
                                            <div class="team_link">
                                                <img src={{ $country->flag_url() }}>{{ $country->name }}
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>

                    <li id="sub_item_games"><a id="main_link" href="#">Games</a><img src="images/arrow-drop-down.svg">
                        <div class="menu_sub_games">
                            <div class="calendar_container">
                                <span id="calendar_title"><span class="june">june</span> / <span class="july">july</span> 2021</span>
                                <ul class="flex-container wrap">
                                    <li class="flex-item-inactive grey">07</li>
                                    <li class="flex-item-inactive grey">08</li>
                                    <li class="flex-item-inactive grey">09</li>
                                    <li class="flex-item-inactive grey">10</li>
                                    <li class="flex-item june"><a onclick="scrollWin(june11);">11</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june12);">12</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june13);">13</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june14);">14</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june15);">15</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june16);">16</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june17);">17</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june18);">18</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june19);">19</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june20);">20</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june21);">21</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june22);">22</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june23);">23</a></li>
                                    <li class="flex-item-inactive grey">24</li>
                                    <li class="flex-item-inactive grey">25</li>
                                    <li class="flex-item june"><a onclick="scrollWin(june26);">26</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june27);">27</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june28);">28</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june29);">29</a></li>
                                    <li class="flex-item-inactive grey">30</li>
                                    <li class="flex-item-inactive grey">01</li>
                                    <li class="flex-item july"><a onclick="scrollWin(july2);">02</a></li>
                                    <li class="flex-item july"><a onclick="scrollWin(july3);">03</a></li>
                                    <li class="flex-item-inactive grey">04</li>
                                    <li class="flex-item-inactive grey">05</li>
                                    <li class="flex-item july"><a onclick="scrollWin(july6);">06</a></li>
                                    <li class="flex-item july"><a onclick="scrollWin(july7);">07</a></li>
                                    <li class="flex-item-inactive grey">08</li>
                                    <li class="flex-item-inactive grey">09</li>
                                    <li class="flex-item-inactive grey">10</li>
                                    <li class="flex-item july"><a onclick="scrollWin(july11);">11</a></li>
                                    <li class="flex-item-inactive grey">12</li>
                                    <li class="flex-item-inactive grey">13</li>
                                    <li class="flex-item-inactive grey">14</li>
                                    <li class="flex-item-inactive grey">15</li>
                                    <li class="flex-item-inactive grey">16</li>
                                </ul>
                            </div>

                            <div class="games_container" id="games_container">
                                @foreach(App\Models\Game::selectRaw("DISTINCT DATE_FORMAT(game_date, '%Y-%m-%d') date")->get() as $games_dates)
                                    <div class="gameday_container" id="{{ $games_dates->scroll_anchor() }}">
                                        <div class="gameday_date">
                                            {!! $games_dates->playdate() !!}
                                        </div>
                                        <ul>
                                            @foreach($fixturenum = App\Models\Game::where("game_date", "LIKE", "%" . $games_dates->date ."%")->get() as $fixture)
                                                <li class="{{ $fixturenum->count() > 3 ? 'gameday_four' : 'gameday_three' }}" id="{{ $fixture->id }}">
                                                    <span id="gameday_time">{{ $fixture->playtime() }}</span>
                                                    <span id="gameday_homeTeam">{{ $fixture->group_id == 0 ? $fixture->hometeam_name : $fixture->homeTeam->name }}</span>
                                                    <span id="gameday_homeTeam_flag"><img src="{{ $fixture->group_id == 0 ? "images/country_flags/qualifier.png" : $fixture->homeTeam->flag_url() }}"></span>
                                                    <span id="gameday_homeTeam_score">{{ $fixture->home_team_score }}</span>
                                                    <span id="hyphen">-</span>
                                                    <span id="gameday_awayTeam_score">{{ $fixture->away_team_score }}</span>
                                                    <span id="gameday_awayTeam_flag"><img src="{{ $fixture->group_id == 0 ? "images/country_flags/qualifier.png" : $fixture->awayTeam->flag_url() }}"></span>
                                                    <span id="gameday_awayTeam">{{ $fixture->group_id == 0 ? $fixture->awayteam_name : $fixture->awayTeam->name }}</span>
                                                    <p id="gameday_stadium">{{ $fixture->stadium->name }}, {{ $fixture->stadium->city }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
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

<script>
    var lekker = document.getElementById('games_container');
    // Define the offset of the calendar
    var offsetX = 190;
    // Define all x positions of playdate divs
    var june11 = document.getElementById('june11').getBoundingClientRect().x;
    var june12 = document.getElementById('june12').getBoundingClientRect().x;
    var june13 = document.getElementById('june13').getBoundingClientRect().x;
    var june14 = document.getElementById('june14').getBoundingClientRect().x;
    var june15 = document.getElementById('june15').getBoundingClientRect().x;
    var june16 = document.getElementById('june16').getBoundingClientRect().x;
    var june17 = document.getElementById('june17').getBoundingClientRect().x;
    var june18 = document.getElementById('june18').getBoundingClientRect().x;
    var june19 = document.getElementById('june19').getBoundingClientRect().x;
    var june20 = document.getElementById('june20').getBoundingClientRect().x;
    var june21 = document.getElementById('june21').getBoundingClientRect().x;
    var june22 = document.getElementById('june22').getBoundingClientRect().x;
    var june23 = document.getElementById('june23').getBoundingClientRect().x;
    var june26 = document.getElementById('june26').getBoundingClientRect().x;
    var june27 = document.getElementById('june27').getBoundingClientRect().x;
    var june28 = document.getElementById('june28').getBoundingClientRect().x;
    var june29 = document.getElementById('june29').getBoundingClientRect().x;
    // July
    var july2 = document.getElementById('july2').getBoundingClientRect().x;
    var july3 = document.getElementById('july3').getBoundingClientRect().x;
    var july6 = document.getElementById('july6').getBoundingClientRect().x;
    var july7 = document.getElementById('july7').getBoundingClientRect().x;
    var july11 = document.getElementById('july11').getBoundingClientRect().x;

    // This function will scroll to the desired playdate
    function scrollWin(waarheen) {
        lekker.scroll(waarheen-offsetX, 0);
    }

    (function() {
        function scrollHorizontally(e) {
            e = window.event || e;
            var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
            // Multiplied by 400 so the scroll snapping is active and noticable
            document.getElementById('games_container').scrollLeft -= (delta * 400);
            // Prevent it from scroll vertically
            e.preventDefault();
        }
        if (document.getElementById('games_container').addEventListener) {
            // IE9, Chrome, Safari, Opera
            document.getElementById('games_container').addEventListener('mousewheel', scrollHorizontally, false);
            // Firefox
            document.getElementById('games_container').addEventListener('DOMMouseScroll', scrollHorizontally, false);
        } else {
            // IE 6/7/8
            document.getElementById('games_container').attachEvent('onmousewheel', scrollHorizontally);
        }
    })();
</script>
</html>
