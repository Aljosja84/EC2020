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

    /**
     * @return string
     */
    public function path()
    {
        return "/games/{$this->id}";
    }

    public function playdate()
    {
        // convert the string to a time format
        $time = strtotime($this->date);
        // return the string
       return date('l', $time) . ' <span class="' . strtolower(date('F', $time)) . '">' . date('F', $time) . '</span> ' . date('j', $time);
    }

    public function playtime()
    {
        // convert the string to a time format &
        // return the string
        return date('H:i', strtotime($this->game_date));
    }

    public function scroll_anchor()
    {
        $time = strtotime($this->date);
        return strtolower(date('F', $time)) . date('j', $time);
    }
}
