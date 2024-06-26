<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- header for Laravel Echo -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Scripts -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
    <script>
        window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        'user' => Auth::user(),
        'pusherKey' => config('broadcasting.connections.pusher.key'),
         ]) !!};
    </script>

    <script defer src="{{ mix('js/app.js') }}"></script>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

    <!-- Styles -->
    <link href={{ asset('css/topmenu.css') }} rel="stylesheet">
    <link href={{ asset('css/ec2020.css') }} rel="stylesheet">
    <title>Euro 2020</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Terminal+Dosis:400,700" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <script>
        var assetBaseUrl = "{{ asset('') }}";
    </script>
</head>
<body>
<?php
    $user = auth()->user();
    $userId = $user->id;
?>
<header>
    <nav>
        <div class="topmenu">
            <!-- EURO 2020 LOGO -->
            <div style="float: left">
                <img class="logo" src={{ asset('images/logo_euro2020.png') }}>
            </div>
            <!-------------------->
            <div class="container">
                <ul class="menu-main">
                    <li id="sub_item_stadium"><a id="main_link" href="#">Stadiums</a><img src={{ asset('images/arrow-drop-down.svg') }}>
                        <div class="menu_sub_stadium">
                            <ul>>
                                @foreach($stadiums as $stadium)
                                    <li id="stadium">
                                        <div class="stadium_link" id="{{ $stadium->abv }}">
                                            <p><img src="{{ asset('images/' . $stadium->url_menu) }}"></p>
                                            <p>{{ $stadium->city }}</p>
                                            <p>{{ $stadium->name }}</p>
                                            <p>seats {{ $stadium->capacity }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>

                    <li id="sub_item_groups"><a id="main_link" href="#">Groups</a><img src={{ asset('images/arrow-drop-down.svg') }}>
                        <div class="menu_sub_groups">
                            <ul>
                                @foreach($groups as $group)
                                <li id="group">
                                    <div class="group_link">
                                        <a href="#">group {{ $group->name }}</a><img src={{ asset('images/arrow-drop-down.svg') }}>
                                    </div>
                                    <div class="group_sub">
                                        <div class="group_sub_wrapper">
                                            @foreach($group->countries as $country)
                                                <p><img src="{{ asset('images/country_flags/' . $country->flag_url) }}"/>{{ $country->name }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>

                    <li id="sub_item_teams"><a id="main_link" href="#">Teams</a><img src={{ asset('images/arrow-drop-down.svg') }}>
                        <div class="menu_sub_teams">
                            <ul>
                                @foreach($countries as $country)
                                    <li id="team">
                                        <a href="/team/{{ $country->id }}">
                                            <div class="team_link">
                                                <img src="{{ asset($country->flag_url()) }}">{{ $country->name }}
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>

                    <li id="sub_item_games"><a id="main_link" href="#">Games</a><img src={{ asset('images/arrow-drop-down.svg') }}>
                        <div class="menu_sub_games">
                            <div class="calendar_container">
                                <span id="calendar_title"><span class="june">june</span> / <span class="july">july</span> 2021</span>
                                <ul class="flex-container wrap">
                                    <li class="flex-item-inactive grey">07</li>
                                    <li class="flex-item-inactive grey">08</li>
                                    <li class="flex-item-inactive grey">09</li>
                                    <li class="flex-item-inactive grey">10</li>
                                    <li class="flex-item june"><a onclick="scrollWin(june11);return false;">11</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june12);return false;">12</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june13);return false;">13</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june14);return false;">14</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june15);return false;">15</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june16);return false;">16</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june17);return false;">17</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june18);return false;">18</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june19);return false;">19</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june20);return false;">20</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june21);return false;">21</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june22);return false;">22</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june23);return false;">23</a></li>
                                    <li class="flex-item-inactive grey">24</li>
                                    <li class="flex-item-inactive grey">25</li>
                                    <li class="flex-item june"><a onclick="scrollWin(june26);return false;">26</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june27);return false;">27</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june28);return false;">28</a></li>
                                    <li class="flex-item june"><a onclick="scrollWin(june29);return false;">29</a></li>
                                    <li class="flex-item-inactive grey">30</li>
                                    <li class="flex-item-inactive grey">01</li>
                                    <li class="flex-item july"><a onclick="scrollWin(july2);return false;">02</a></li>
                                    <li class="flex-item july"><a onclick="scrollWin(july3);return false;">03</a></li>
                                    <li class="flex-item-inactive grey">04</li>
                                    <li class="flex-item-inactive grey">05</li>
                                    <li class="flex-item july"><a onclick="scrollWin(july6);return false;">06</a></li>
                                    <li class="flex-item july"><a onclick="scrollWin(july7);return false;">07</a></li>
                                    <li class="flex-item-inactive grey">08</li>
                                    <li class="flex-item-inactive grey">09</li>
                                    <li class="flex-item-inactive grey">10</li>
                                    <li class="flex-item july"><a onclick="scrollWin(july11);return false;">11</a></li>
                                    <li class="flex-item-inactive grey">12</li>
                                    <li class="flex-item-inactive grey">13</li>
                                    <li class="flex-item-inactive grey">14</li>
                                    <li class="flex-item-inactive grey">15</li>
                                    <li class="flex-item-inactive grey">16</li>
                                </ul>
                            </div>

                            <div class="games_container" id="games_container">
                                <div id="games_scroll_vue">
                                @foreach($gamesdates as $games_dates)
                                    <div class="gameday_container" id="{{ $games_dates->scroll_anchor() }}">
                                        <div class="gameday_date">
                                            {!! $games_dates->playdate() !!}
                                        </div>
                                        <ul>
                                            @foreach($fixturenum = App\Models\Game::with(['users' => function ($query) use ($userId) { $query->where('user_id', $userId); }])->where("game_date", "LIKE", "%" . $games_dates->date ."%")->get() as $fixture)
                                                <a href="{{ $fixture->path() }}">
                                                    <li class="{{ $fixturenum->count() > 3 ? 'gameday_four' : 'gameday_three' }}" id="{{ $fixture->id }}">
                                                        <!-- follow game vue component -->
                                                        <div class="follow_icon"><follow-game-button :topmenu="true" :followed="{{ $fixture->users }}" :game-id="{{ $fixture->id }}"></follow-game-button></div>
                                                        <span id="gameday_time">{{ $fixture->playtime() }}</span>
                                                        <span id="gameday_homeTeam">{{ $fixture->home_team_id == 0 ? $fixture->hometeam_name : $fixture->homeTeam->name }}</span>
                                                        <span id="gameday_homeTeam_flag"><img src="{{ asset($fixture->home_team_id == 0 ? "images/country_flags/qualifier.png" : $fixture->homeTeam->flag_url()) }}"></span>
                                                        <span id="gameday_homeTeam_score">{{ $fixture->home_team_score }}</span>
                                                        <span id="hyphen">-</span>
                                                        <span id="gameday_awayTeam_score">{{ $fixture->away_team_score }}</span>
                                                        <span id="gameday_awayTeam_flag"><img src="{{ asset($fixture->away_team_id == 0 ? "images/country_flags/qualifier.png" : $fixture->awayTeam->flag_url()) }}"></span>
                                                        <span id="gameday_awayTeam">{{ $fixture->away_team_id == 0 ? $fixture->awayteam_name : $fixture->awayTeam->name }}</span>
                                                        <p id="gameday_stadium">{{ $fixture->stadium->name }}, {{ $fixture->stadium->city }}</p>
                                                    </li>
                                                </a>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- user notifications and user settings -->
            <div id="notify_user_icons">
                @auth
                    <div><notifications :user-id={{ $user->id }}></notifications></div>
                    <div>
                        <login username={{ $user->name }} avatar={{ $user->avatar->ava_url() }} :spoiler="false" :groups='{{ $user->pool }}'></login>
                    </div>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="login_button">Log in</a>
                    <a href="{{ route('register') }}" class="register_button">Sign up</a>
                @endguest
            </div>
        </div>
        <!-- end user notifications and user settings -->
    </nav>
</header>

@yield('content')
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
</body>
<script src={{ asset('js/topmenu.js') }}></script>
</html>
