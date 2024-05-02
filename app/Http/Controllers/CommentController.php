<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Country;
use App\Models\Game;
use App\Models\Group;
use App\Models\Player;
use App\Models\Stadium;
use App\Models\User;
use App\Notifications\CommentAdded;
use Illuminate\Http\Request;

class CommentController extends Controller
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::all();
        $user = Auth()->user();
        $players = Country::has('players')->with('players')->get();
        $games = $user->games()->with('homeTeam')->with('awayTeam')->get();

        return view('comment', [
            'user' => $user,
            'users' => $users,
            'players' => $players,
            'games' => $games,
            'stadiums' => $this->stadiums,
            'groups' => $this->groups,
            'countries' => $this->countries,
            'gamesdates' => $this->gamesdates,

        ]);

    }

    /**
     * Return the first fixture where hometeam is equal to the api country code
     * so that we can pass it to function in playerselect vue component.
     *
     * @param $id
     * @return void
     */
    public function findFixture($id)
    {
        return $fixture_id = Game::whereHas('homeTeam', function ($query) use ($id) {
               $query->where('api_country_code', $id);
               })->value('api_id');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        # validate request first
        $request->validate([
            'comment' => 'required|min:3',
            'logged_user' => 'required',
            'recip_user' => 'required'
        ]);

        # make new comment and persist to database
        $newComment = new Comment();
        $newComment->user_id = $request->input('logged_user');
        $newComment->betstrip_id = '1';
        $newComment->recipient_id = $request->input('recip_user');
        $newComment->comment = $request->input('comment');

        $newComment->save();
        //dd($newComment);

        # send notification to user
        User::find($newComment->recipient_id)->notify(new CommentAdded($newComment));

        # redirect to /comment
        return redirect()->route('comment');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
}
