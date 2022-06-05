<?php

namespace App\Http\Controllers;

use App\Models\Pool;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\NewChatMessage;

class PoolController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('pool');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Pool $pool
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Pool $pool)
    {
        return view('pool', [
            'pool' => $pool,
            'chatroom' => $pool->chatroom
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function avatar(User $user)
    {
        return $user->avatar->ava_url();
    }

    /**
     * @param Pool $pool
     * @param ChatRoom $room
     * @return mixed
     */
    public function room(Pool $pool, ChatRoom $room)
    {
        return $room;
    }

    /**
     * @param Request $request
     * @param Pool $pool
     * @return mixed
     */
    public function messages(Request $request, Pool $pool)
    {
        return ChatMessage::where('chat_room_id', $pool->chatroom->id)
            ->with(['user' => function($user) {
                $user->with('avatar')->get();
            }])
            ->orderBy('created_at', 'ASC')
            ->get();
    }

    /**
     * @param Request $request
     * @param $roomId
     * @param $userId
     * @return ChatMessage
     */
    public function newMessage(Request $request, $roomId)
    {
        $user = Auth::user();
        $newMessage = new ChatMessage;
        $newMessage->user_id = $user->id;
        $newMessage->chat_room_id = $roomId;
        $newMessage->message = $request->message;
        // commit to database
        $newMessage->save();
        // broadcast to others
        broadcast(new NewChatMessage( $user, $newMessage ));
        // return the new message
        return $newMessage;

    }

}
