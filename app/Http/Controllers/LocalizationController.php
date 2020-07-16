<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($locale)
    {
         App::setLocale($locale);
        //storing the locale in session to get it back in the middleware
        session()->put('locale', $locale);
        return redirect()->back();
    }

}
