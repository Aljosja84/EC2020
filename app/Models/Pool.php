<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pool extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany('App\Models\User', 'pool_members');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function chatroom()
    {
        return $this->hasOne('App\Models\ChatRoom');
    }

    /**
     * @param User $user
     */
    public function invite(User $user)
    {
        return $this->members()->attach($user);
    }

    public function membersWithPoints()
    {
    }
}

