@extends('layouts.navi')

@section('content')
    <div class="games_div_container">
        {{ $country->name }} flag: <img src="../{{ $country->flag_url() }}">
    </div>
@endsection
