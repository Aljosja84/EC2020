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
}
