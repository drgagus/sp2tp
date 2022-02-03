<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PustuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user->servicecenteruser):
            if ($user->servicecenteruser->servicecenter_id == 1):
                return abort('401');
            else:
                return $next($request);
            endif;
        else:
            return abort('401');
        endif;
    }
}
