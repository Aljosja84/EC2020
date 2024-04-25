<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * @param Request $request
     * @param User $user
     * @param Game $game
     * @return string
     */
    public function followGame(Request $request, User $user, Game $game)
    {
        $user->games()->attach($game);

        return 'user has followd game';
    }

    /**
     * @param Request $request
     * @param User $user
     * @param Game $game
     */
    public function unfollowGame(Request $request, User $user, Game $game)
    {
        $user->games()->detach();

        return 'user has unfollowed game';
    }

    /**
     * @param $id
     * @return bool
     */
    public function isFollowing($id)
    {
        // user must be the logged in user
        $user = auth()->user();

        // check if logged in user has an entry in the pivot table
        // meaning they're following the game
        if($user->games()->find($id)) {
            return true;
        }
        return false;
    }
}
