<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function store(Request $request)
    {
        foreach ($request->input('teamPlayers') as $player) {

            Player::create([
                'player_id' => $player['player']['id'],
                'country_id' => $request->input('teamId'),
                'name' => $player['player']['name'],
                'number' =>  $player['player']['number'],
                'position' => $player['player']['pos']
            ]);
        }

        return response()->json(['message' => 'Players saved to database!']);

    }
}
