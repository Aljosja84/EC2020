<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class Pool
{
    /**
     * Handle an incoming request.
     *
     * @param Pool $pool
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // firstly the user has to be logged in
        if (!Auth::check()) {
            return redirect('home');
        }

        $user = Auth::user();
        $pool = $request->route()->parameter('pool');

        // check if the logged in user is part of the pool it's trying to access
        if($pool->members) {
            if($pool->members->contains($user))
            {
                return $next($request);
            }
        }   else {
            return redirect('home');
        }
        // if not, go home - you're drunk
        return redirect('home');
    }
}
