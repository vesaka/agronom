<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
/**
 * Description of IsAdmin
 *
 * @author Vesaka
 */
class IsAdmin {
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::user()->level !== 1) {
            return redirect('/home');
        }

        return $next($request);
    }
}
