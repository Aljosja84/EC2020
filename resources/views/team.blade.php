@extends('layouts.navi')

@section('content')
    <div class="games_div_container">
        <div id="app">
            <!--<team-form details="{{$country->name}}" flag="../{{$country->flag_url()}}" teamid="{{ $country->api_country_code }}" style="float: left; margin-right: 15px"></team-form>-->
            <team-players teamid="{{ $country->api_country_code }}" style="float: left;"></team-players>
        </div>
    </div>
    <div class="footer_teampage"></div>
@endsection
