<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;

    public function user()
    {
        $this->belongsTo('App\Models\User');
    }

    public function ava_url()
    {
        return "/images/avatars/{$this->url}";
    }
}
