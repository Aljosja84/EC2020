<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'avatar_id',
        'country_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function avatar()
    {
        return $this->belongsTo('App\Models\Avatar');
    }

    public function pool()
    {
        return $this->belongsToMany('App\Models\Pool', 'pool_members');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Chatmessage');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function games()
    {
        return $this->belongsToMany('App\Models\Game', 'user_game');
    }

    public function bets()
    {
        return $this->hasMany(Bet::class);
    }

    public function totalPoints()
    {
        return $this->bets()->sum('points');
    }
}
