<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuthenticated {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if( Auth::check() ) {
            if ( Auth::user()->isAdmin() ) {
                return redirect(route('series.list'));
            } else {
                return $next($request);
            }
        }

        return redirect(route('login'))->with(['success' => Auth::user()]);
    }
}
