@extends('layouts.navi')

@section('content')
   <div class="games_div_container">
       <div id="app">
           <div class="group_standing_win">
               <div class="group_standing_win_header">
                   group standings
               </div>
               <div class="separator_bar"></div>
               @foreach($members as $member)
                   <div><span>{{ $member->avatar->ava_url() }}</span>{{ $member->name }}</div>
               @endforeach
           </div>

           <div class="chatwindow_container">
               <br>
               <chat :poolid="{{ $pool->id }}" :roomid="{{ $chatroom->id }}" :userid="{{ auth()->user()->id }}"></chat>
           </div>
       </div>
   </div>
@endsection
