@extends('layouts.navi')

@section('content')
    <div class="games_div_container">
        <div id="app">
            <div class="scoreboard_comp">
                <scoreboard></scoreboard>
            </div>

            <div class="lineup_home">
                <lineup team="hometeam"></lineup>
            </div>

            <div class="event_win">
                <events-window></events-window>
            </div>

            <div class="lineup_away">
                <lineup team="awayteam"></lineup>
            </div>

            <div class="stats_win">
               <stats-win></stats-win>
            </div>
        </div>
    </div>
@endsection
