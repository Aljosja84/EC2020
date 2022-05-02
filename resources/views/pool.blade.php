@extends('layouts.navi')

@section('content')
   <div class="games_div_container">
       <div>
           @foreach($pool->users as $user)
               <span>{{ $user->email }}</span>
           @endforeach
       </div>
   </div>
@endsection
