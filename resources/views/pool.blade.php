@extends('layouts.navi')

@section('content')
   <div class="games_div_container">
       <div id="app">
           <div>
               {{ $chatroom->name }}
               <chat :poolid="{{ $pool->id }}" :roomid="{{ $chatroom->id }}" :userid="{{ auth()->user()->id }}"></chat>
           </div>
       </div>
   </div>
@endsection
