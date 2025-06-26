<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || (!Auth::user()->isPetugas() && !Auth::user()->isSuperadmin())) {
            return redirect('/login')->with('error', 'Access denied');
        }

        return $next($request);
    }
}