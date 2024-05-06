<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Game;
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

    public function getPlayersFromGame($gameId)
    {

        $game = Game::findOrFail($gameId);

        // Retrieve the country codes of the home and away teams
        $homeCountryCode = $game->homeTeam->api_country_code;
        $awayCountryCode = $game->awayTeam->api_country_code;

        // Query the countries that have players associated with them
        return Country::whereHas('players', function ($query) use ($homeCountryCode, $awayCountryCode) {
            $query->where('api_country_code', $homeCountryCode)
                  ->orWhere('api_country_code', $awayCountryCode);
        })
            ->with('players')
            ->get();
    }
}
