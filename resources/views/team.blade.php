@extends('layouts.navi')

@section('content')
    <div class="games_div_container">
        <div id="app">
            <!--<team-form details="{{$country->name}}" flag="../{{$country->flag_url()}}" teamid="{{ $country->api_country_code }}" style="float: left; margin-right: 15px"></team-form>-->
            <team-players teamid="{{ $country->api_country_code }}" style="float: left;"></team-players>
        </div>
        <div class="group_standings_wrapper">
            <div class="group_standings_container">
                <div class="content_header">
                    group {{ $country->group->name }}
                </div>
                <div class="separator_bar"></div>
                <div>
                    @foreach($country->group->countriesRank as $groupmember)
                        {{ $groupmember->name }}
                        <br/>
                    @endforeach
                </div>
            </div>
            <div class="next_game_container">
                content
            </div>
        </div>
    </div>
    <div class="footer_teampage"></div>
@endsection
