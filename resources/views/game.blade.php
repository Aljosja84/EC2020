@extends('layouts.navi')

@section('content')
    <div class="games_div_container">
        <div id="stadium_info">
            <div class="match_info">match </div>
            <div class="stad_pic">
                <img src="images/Bilboa_Stadium_Bird.png" />
            </div>
            <ul>
                <li>
                    <span class="stad_info_header">Name:</span>
                    <span class="stad_info_info"></span>
                </li>
                <li>
                    <span class="stad_info_header">Capacity:</span>
                    <span class="stad_info_info"></span>
                </li>
                <li>
                    <span class="stad_info_header">City:</span>
                    <span class="stad_info_info"></span>
                </li>
                <li>
                    <span class="stad_info_header">Address:</span>
                    <span class="stad_info_info"></span>
                </li>
                <li>
                    <span class="stad_info_header">Built:</span>
                    <span class="stad_info_info"></span>
                </li>
            </ul>
        </div>
        <div id="app">
            <match matchid="573243"></match>
        </div>
    </div>
@endsection
