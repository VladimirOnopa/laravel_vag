<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Localization
{
    public function handle($request, Closure $next)
    {
        if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }else{
        	 session()->put('locale', App::getLocale());
        }
        return $next($request);
    }
}