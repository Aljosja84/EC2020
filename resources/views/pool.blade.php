@extends('layouts.navi')

@section('content')
   <div class="games_div_container">
       <div id="app">
           <span>Active users</span>
           <div style="width: 401px; height: 50px; background-color: white"></div>
           <div>
               {{ $chatroom->name }}
               <chat :poolid="{{ $pool->id }}" :roomid="{{ $chatroom->id }}" :userid="{{ auth()->user()->id }}"></chat>
           </div>
       </div>
   </div>
@endsection
