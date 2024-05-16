<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Country::class, 'api_country_code','country_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'api_country_code');
    }
}
