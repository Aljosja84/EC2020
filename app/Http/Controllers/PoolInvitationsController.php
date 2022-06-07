<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pool;

class PoolInvitationsController extends Controller
{
    public function store(Pool $pool)
    {
        // make sure the user to be invited already has an account with us

        request()->validate([
            'email' => ['required', 'exists: users,email']
        ], [
            'email.exists' => 'User must have an account already.'
        ]);

        $user = User::whereEmail(request('email'))->first();

        $pool->invite($user);
    }
}
