<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserGameController extends Controller
{
    public function isFollowing($id)
    {
        $user = Auth::user();
        $games = $user->games()->get();

        return response()->json($games);
    }
}
