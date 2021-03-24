<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Sentinel;

class AdminMiddleware
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
        //1. user should be authenticated

        //2. authenticated user should be an admin
        if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'admin')
        {
            return $next($request);
        }
        else
            return redirect('/');
    }
}
