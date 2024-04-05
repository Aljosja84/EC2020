@extends('layouts.navi')

@section('content')
<div class="games_div_container" style="display: flex; justify-content: center; align-items: center">
    <div id="stadium_info" >
        <form action="{{ route('comment.store') }}" method="POST">
            @csrf
            Send notification to User:
            <select id="logged_user" name="logged_user" style="width: 100%">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            Logged in as User:
            <select id="recip_user" name="recip_user" style="width: 100%">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            With the following Comment:
            <textarea id="comment" name="comment" rows="5" style="width: 100%"></textarea>
            <div style="height: 20px">--</div>
            <button class="comment_submit_button" type="submit">Send Notification</button>
        </form>
    </div>
</div>
@endsection
