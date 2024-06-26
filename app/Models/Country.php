<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function game() {
        return $this->hasMany('App\Models\Game');
    }

    public function flag_url()
    {
        return "images/country_flags/{$this->flag_url}";
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    public function players()
    {
        return $this->hasMany(Player::class, 'country_id', 'api_country_code');
    }
}
