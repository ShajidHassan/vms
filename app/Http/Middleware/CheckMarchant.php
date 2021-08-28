<?php

namespace App\Http\Middleware;

use Closure;

class CheckMarchant
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
        if(!\Illuminate\Support\Facades\Session::has('marchant_email'))
        {
            return redirect()->route("marchant.signin")->with('message_error','Please Sign in to access');

        }
        return $next($request);
    }
}
