<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $dates = ['game_date'];

    public function stadium() {
        return $this->belongsTo('App\Models\Stadium');
    }

    public function homeTeam() {
        return $this->belongsTo('App\Models\Country');
    }

    public function awayTeam() {
        return $this->belongsTo('App\Models\Country');
    }

    public function probeersel()
    {
       return $this::selectRaw("DISTINCT DATE_FORMAT(game_date, '%Y-%m-%d') date")->get();
    }
}
