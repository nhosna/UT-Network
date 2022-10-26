<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class UserAuthenticated
{
    public function handle($request, Closure $next)
    {
        if( Auth::check() )
        {
            // if user admin take him to his dashboard
            if ( Auth::user()->isAdmin() ) {
                return redirect(route('/admin'));
            }

            // allow user to proceed with request
            else if ( Auth::user()->isUser() ) {
                return $next($request);
            }
        }
//        abort(404);

        return redirect(route('login'));
    }
}
