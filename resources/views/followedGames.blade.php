@extends('layouts.navi')

@section('content')

<div class="games_div_container">
    <div id="app">
        <user-followed-games :user="{{auth()->user()}}"
                             :gamesdates="{{$gamesdates}}"
                             :followedgames="{{$games}}"
                             :countries="{{$countries}}"
        ></user-followed-games>
    </div>
</div>
@endsection
