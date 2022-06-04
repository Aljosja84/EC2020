<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    use HasFactory;

    public function members()
    {
        return $this->belongsToMany('App\Models\User', 'pool_members');
    }

    public function chatroom()
    {
        return $this->hasOne('App\Models\ChatRoom');
    }

    public function invite(User $user)
    {
        return $this->members()->attach($user);
    }
}

