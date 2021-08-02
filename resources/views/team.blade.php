@extends('layouts.navi')

@section('content')
    <div class="games_div_container">
        <div id="app">
             <team-form details="{{$country->name}}" flag="../{{$country->flag_url()}}" teamid="{{ $country->api_country_code }}"></team-form>
        </div>
    </div>
@endsection
