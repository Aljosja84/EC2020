@extends('layouts.navi')

@section('content')
<div class="games_div_container" style="display: flex; justify-content: center; align-items: center">
    <div id="app">
        <div id="stadium_info" >
            <form action="{{ route('comment.store') }}" method="POST">
                @csrf
                Comment came from user:
                <select id="logged_user" name="logged_user" style="width: 100%">
                    @foreach ($users as $logged_user)
                        <option value="{{ $logged_user->id }}">{{ $logged_user->name }}({{ $logged_user->id }})</option>
                    @endforeach
                </select>
                Comment sent to user:
                <select id="recip_user" name="recip_user" style="width: 100%">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}({{ $user->id }})</option>
                    @endforeach
                </select>
                With the following Comment:
                <textarea id="comment" name="comment" rows="5" style="width: 100%"></textarea>
                <div style="height: 20px">--</div>
                <button class="comment_submit_button" type="submit">Send Notification</button>
            </form>
        </div>
        <!-- dropdown menu for goal notifications -->
        <div id="stadium_info" style="margin-left: 15px">
            <player-dropdown :items="{{ $players }}"></player-dropdown>
        </div>
        <!-- form to get countries and players loaded -->
        <div id="stadium_info" style="margin-left: 15px">
            <player-select :countries="{{ $countries }}"></player-select>
        </div>
    </div>
</div>
@endsection
