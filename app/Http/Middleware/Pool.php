<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function handle(Request $request, Closure $next, $pool)
    {
        if (!Auth::check())
            return redirect('login');

        $user = Auth::user();

        if($pool->members->contain($user))
            return $next($request);

        return redirect('home');
    }
}
