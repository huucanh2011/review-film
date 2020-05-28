<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check())
            return redirect()->route('home');

        $quyenId = Auth::user()->quyen_id;
        if ($quyenId > 1)
            return redirect()->route('home');

        return $next($request);
    }
}
