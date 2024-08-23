@extends('layouts.navi')

@section('content')
   <div class="games_div_container">
       <div id="app">
           <div class="group_standing_win">
               <div class="group_standing_win_header">
                   group standings
               </div>
               <div class="separator_bar"></div>
               <div class="group_standing_win_sub_header">
                   <span style="width: 20px">#</span><span style="width: 170px">name</span><span style="width: 40px">points</span>
               </div>
               @foreach($members as $member)
                   <div class="group_standing_win_player_div" style="padding-left: 10px">
                       <span style="width: 20px;">{{$member->id}}</span>
                       <span style="width: 170px; display: flex; align-items: center;">
                            <img width="20px" height="20px" src="{{ $member->avatar->ava_url() }}" />
                            <span>{{ $member->name }}</span>
                        </span>
                       <span style="width: 40px;">{{ $member->totalPoints() }}</span>
                   </div>
               @endforeach
           </div>

           <div class="chatwindow_container">
               <br>
               <chat :poolid="{{ $pool->id }}" :roomid="{{ $chatroom->id }}" :userid="{{ auth()->user()->id }}"></chat>
           </div>
       </div>
   </div>
@endsection
