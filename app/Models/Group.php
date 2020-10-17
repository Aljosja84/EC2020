<?php

namespace App\Models;
use App\Models\Country;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function countries()
    {
        return $this->hasMany('App\Models\Country');
    }

    public function games()
    {
        return $this->hasMany('App\Models\Game');
    }
}
