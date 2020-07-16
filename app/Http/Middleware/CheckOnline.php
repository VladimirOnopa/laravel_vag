<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class CheckOnline
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
         if (auth()->guest()) {
            return $next($request);
        }
        if (auth()->user()->last_active->diffInHours(now()) !==0)
        { 
            DB::table("users")
              ->where("id", auth()->user()->id)
              ->update(["last_active" => now()]);
        }
        return $next($request);
    }
}
