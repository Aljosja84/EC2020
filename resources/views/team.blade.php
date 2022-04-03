@extends('layouts.navi')

@section('content')
    <div class="games_div_container">
        <div id="app">
            <!--<team-form details="{{$country->name}}" flag="../{{$country->flag_url()}}" teamid="{{ $country->api_country_code }}" style="float: left; margin-right: 15px"></team-form>-->
            <team-players teamid="{{ $country->api_country_code }}" style="float: left;"></team-players>

            <div class="group_standings_wrapper">
                <div class="group_standings_container">
                    <div class="content_header">
                        group {{ $country->group->name }}
                    </div>
                    <div class="separator_bar"></div>
                    <div id="title_div">
                        <span style="width: 20px; text-align: center">#</span>
                        <span style="width: 200px; padding-left: 23px">team</span>
                        <span style="width: 73px; text-align: center">points</span>
                        <span style="width: 35px; text-align: center">mp</span>
                        <span style="width: 35px; text-align: center">w</span>
                        <span style="width: 35px; text-align: center">d</span>
                        <span style="width: 35px; text-align: center">l</span>
                        <span style="width: 35px; text-align: center">gd</span>
                    </div>
                    <div>
                        <ul>
                        @foreach($country->group->countriesRank as $groupmember)
                            <li class="group_standing_team_listitem">
                                <div style="width: 20px; text-align: center; font-family: 'Oswald', sans-serif; font-size: 22px; line-height: 45px; float: left">
                                    {{ $groupmember->rank }}
                                </div>
                                <div style="width: 35px; height: 100%; padding-left: 6px; float: left; padding-top: 10px">
                                    <img src="../{{ $groupmember->flag_url() }}" width="25px" height="25px" style="margin-right: 1px">
                                </div>
                                <div style="float: left; width: 175px; padding-top:13px; padding-left: 3px">{{ $groupmember->name }}</div>
                                <div class="separator_div" style="float: left"></div>
                                <div style="width: 73px; padding-top: 13px; border-left: 1px solid white; text-align: center">{{ $groupmember->points }}</div>
                                <div class="separator_div" style="float: left"></div>
                                <div style="width: 40px; padding-top: 13px; border-left: 1px solid white; text-align: center">{{ $groupmember->GP }}</div>
                                <div class="separator_div" style="float: left"></div>
                                <div style="width: 40px; padding-top: 13px; border-left: 1px solid white; text-align: center">{{ $groupmember->GW }}</div>
                                <div class="separator_div" style="float: left"></div>
                                <div style="width: 40px; padding-top: 13px; border-left: 1px solid white; text-align: center">{{ $groupmember->GD }}</div>
                                <div class="separator_div" style="float: left"></div>
                                <div style="width: 40px; padding-top: 13px; border-left: 1px solid white; text-align: center">{{ $groupmember->GL }}</div>
                                <div class="separator_div" style="float: left"></div>
                                <div style="width: 35px; padding-top: 13px; border-left: 1px solid white; text-align: center">{{ $groupmember->GDiff }}</div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="next_game_container">
                    <next-game teamid="{{ $country->api_country_code }}"></next-game>
                </div>
            </div>
        </div><div class="footer_teampage"></div>
    </div>

@endsection
