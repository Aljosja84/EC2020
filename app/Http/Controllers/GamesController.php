<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Game;
use App\Models\Group;
use App\Models\Stadium;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public $stadiums;
    public $groups;
    public $countries;
    public $gamesdates;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->stadiums = Stadium::orderBy('city', 'asc')->get();
        $this->groups = Group::orderBy('name', 'asc')->get();
        $this->countries = Country::orderBy('name', 'asc')->get();
        $this->gamesdates = Game::selectRaw("DISTINCT DATE_FORMAT(game_date, '%Y-%m-%d') date")->get();
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

    /**p
     * @param Game $game
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Game $game)
    {
        return view('game', [
            'game' => $game,
            'stadium' => $game->stadium,
            'stadiums' => $this->stadiums,
            'groups' => $this->groups,
            'countries' => $this->countries,
            'gamesdates' => $this->gamesdates,
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
}
