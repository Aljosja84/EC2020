@extends('layouts.navi')

@section('content')
   <div class="games_div_container">
       <div id="app">
           <div>
               {{ $chatroom->name }}
               <chat />
           </div>
       </div>
   </div>
@endsection
