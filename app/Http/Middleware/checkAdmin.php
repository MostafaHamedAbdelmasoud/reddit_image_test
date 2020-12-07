<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::User();
        if ($user) {
            if ($user->isAdmin()) {
                return $next($request);
            } else {
                abort(404);
            }
        } else {
            return view('login');
        }

    }
}
