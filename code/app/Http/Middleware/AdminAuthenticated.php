<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class AdminAuthenticated extends Middleware
{


    public function redirectTo($request )
    {
        if( Auth::check() )
        {
            // if user admin take him to his dashboard
            if ( Auth::user()->isAdmin() ) {
                return route('home');
            }
            else{
                return route('home');


            }

//            // allow user to proceed with request
//            else if ( Auth::user()->isUser() ) {
//                return $next($request);
//            }
        }

        return redirect(route('login'));
    }






}
