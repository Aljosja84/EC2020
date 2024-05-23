<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifiedEvent extends Model
{
    use HasFactory;

    protected $fillable = ['unique_key', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
