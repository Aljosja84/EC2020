@extends('layouts.navi')

@section('content')

<div class="games_div_container">
    <div id="app">
        <user-followed-games :user="{{auth()->user()}}"
                             :gamesdates="{{$gamesdates}}"
                             :followedgames="{{$followed_games}}"
                             :countries="{{$countries}}"
                             :games="{{$games}}"
        ></user-followed-games>
    </div>
    <div id="bg_pic"></div>
</div>
@endsection
