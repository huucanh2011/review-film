<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HangPhimLogin
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
        if ($quyenId == 3)
            return redirect()->route('home');

        return $next($request);
    }
}
