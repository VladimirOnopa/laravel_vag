<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Поиск по городам и областям 
     *
     * @return object
     */
    public function ajax_search_location(Request $request)
    {
        $input = $request->all();

        $locationRegion =  DB::table('_regions')
                    ->join('_countries', '_countries.country_id', '=', '_regions.country_id')
                    ->select('_regions.region_id as region_id','_regions.title_ru as region', '_countries.title_ru as country')
                    ->where('_regions.title_ru', 'like', $input['location']."%")
                    ->orderByRaw('FIELD(_regions.country_id, "2") DESC, _regions.country_id')
                    ->get();

        $locationCity =  DB::table('_cities')
                    ->join('_countries', '_countries.country_id', '=', '_cities.country_id')
                    ->select('_cities.region_id as region_id','_cities.city_id as city_id','_cities.title_ru as city', '_cities.region_ru as region', '_countries.title_ru as country')
                    ->where('_cities.title_ru', 'like', $input['location']."%")
                    ->orderByRaw('FIELD(_cities.country_id, "2") DESC, _cities.country_id')
                    ->get();   
        
        
        $location = $locationRegion->merge($locationCity);

        return response()->json(array('data'=> $location), 200);
    }

}
