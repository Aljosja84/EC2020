<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Game;
use App\Models\Group;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public $stadiums;
    public $groups;
    public $countries;
    public $gamesdates;
    public $games;
    public $followedgames;
    public $user;

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
        $this->games = Game::with(['homeTeam', 'awayTeam'])->get();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('main', [
            'stadiums' => $this->stadiums,
            'groups' => $this->groups,
            'countries' => $this->countries,
            'gamesdates' => $this->gamesdates,
            ]);
    }

    public function game()
    {
        return view('game');
    }

    public function followedgames()
    {
        return view('followedGames', [
            'stadiums' =>       $this->stadiums,
            'groups' =>         $this->groups,
            'countries' =>      $this->countries,
            'gamesdates' =>     $this->gamesdates,
            'games' =>          $this->games,
            'followed_games' =>  auth()->user()->games()->get(),
        ]);
    }
}
