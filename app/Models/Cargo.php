<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cargo extends Model
{
	protected $table = 'cargo_request';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     *
     *
     *
     * @var array
     */
    protected $fillable = 
    [
		'user_id',
		'load_date_from',
		'load_date_to',
		'load_from_1',
		'load_from_2',
		'load_from_3',
		'load_from_4',
		'load_from_5',
		'load_from_6',
		'load_from_7',
		'unload_to_1',
		'unload_to_2',
		'unload_to_3',
		'unload_to_4',
		'unload_to_5',
		'unload_to_6',
		'unload_to_7',
		'body_type',
		'load_type',
		'size_l',
		'size_w',
		'size_h',
		'weight_max',
		'capacity',
		'quantity_transport',
		'price_show',
		'payment_type',
		'price_amount',
		'nds',
		'currency',
		'per_type',
		'prepay',
		'payment_time',
		'notice',
		'created_at', 
		'refresh_at'
    ];
    /**
     * Получить все заявки грузов пользователя , АКТИВНЫХ или АРХИВНЫХ
     * @param  $user_id ,$active = 0/1 активна или нет
     * @return [array] 
     */
    public function getAllCargoUser($user_id,$active)
    {

        $requests = DB::table('cargo_request')
            ->leftJoin('transport_body_type', 'transport_body_type.id', '=', 'cargo_request.body_type')
            ->leftJoin('cargo_type', 'cargo_type.id', '=', 'cargo_request.cargo_type')
            ->select('cargo_request.*','transport_body_type.name as transport_body_type','cargo_type.name as cargo_type_name')
            ->where([
                ['cargo_request.user_id', '=', $user_id],
                ['active', '=', $active],
            ])
            ->orderBy('created_at', 'desc')
            ->get()->toArray();

        foreach ($requests as $key => $request) {
            $id[]=$request->id;
        }

		/*
        Точки погрузки
         */ 
        foreach ($requests as $key => $request) {
         	$data =  DB::table('cargo_waypoints_source')
         	->leftJoin('_countries', '_countries.country_id', '=', 'cargo_waypoints_source.country')
         	->leftJoin('_regions', '_regions.region_id', '=', 'cargo_waypoints_source.region')
         	->leftJoin('_cities', '_cities.city_id', '=', 'cargo_waypoints_source.city')
            ->select('cargo_waypoints_source.request_id as request_id','_countries.title_ru as country','_regions.title_ru as region','_cities.title_ru as city')
            ->whereIn ('cargo_waypoints_source.request_id' , $id)
            ->get()->toArray();
       
            $requests[$key]->waypoints_source = json_decode(json_encode($data), true);
        } 
        /*
        Точки выгрузки
         */
        foreach ($requests as $key => $request) {
         	$data = DB::table('cargo_waypoints_target')
         	->leftJoin('_countries', '_countries.country_id', '=', 'cargo_waypoints_target.country')
         	->leftJoin('_regions', '_regions.region_id', '=', 'cargo_waypoints_target.region')
         	->leftJoin('_cities', '_cities.city_id', '=', 'cargo_waypoints_target.city')
            ->select('cargo_waypoints_target.request_id as request_id ','_countries.title_ru as country','_regions.title_ru as region','_cities.title_ru as city')
            ->whereIn ('cargo_waypoints_target.request_id' , $id)
            ->get()->toArray();
            $requests[$key]->waypoints_target = json_decode(json_encode($data), true);
        } 
        /*
        Опции по заявке
         */
        foreach ($requests as $key => $request) {
         	$requests[$key]->options = DB::table('options_cargo')
         	->leftJoin('options_description', 'options_description.id', '=', 'options_cargo.option_id')
            ->select('options_description.name','options_cargo.value','options_description.type')
            ->whereIn ('options_cargo.cargo_request_id' , $id)
            ->get();

        } 
        return $requests;  
    }
    /**
     * Получить заявку пользователя по id
     * @param  [type] $user_id          [description]
     * @param  [type] $cargo_request_id [description]
     * @return mixed object
     */
    public function getCargoById($user_id,$cargo_request_id)
    {
        $requests = DB::table('cargo_request')
            ->leftJoin('transport_body_type', 'transport_body_type.id', '=', 'cargo_request.body_type')
            ->leftJoin('cargo_type', 'cargo_type.id', '=', 'cargo_request.cargo_type')
            ->select('cargo_request.*','transport_body_type.name as transport_body_type','cargo_type.name as cargo_type_name')
            ->where([
                ['cargo_request.user_id', '=', $user_id],
                ['active', '=', 1],
                ['cargo_request.id', '=', $cargo_request_id],
            ])
            ->first();
        /*
        Точки погрузки
         */ 
        $requests->waypoints_source =  DB::table('cargo_waypoints_source')
        ->leftJoin('_countries', '_countries.country_id', '=', 'cargo_waypoints_source.country')
        ->leftJoin('_regions', '_regions.region_id', '=', 'cargo_waypoints_source.region')
        ->leftJoin('_cities', '_cities.city_id', '=', 'cargo_waypoints_source.city')
        ->select(
            'cargo_waypoints_source.request_id as request_id',
            '_countries.title_ru as country',
            '_regions.title_ru as region',
            '_cities.title_ru as city',
            '_countries.country_id',
            '_regions.region_id',
            '_cities.city_id',
        )
        ->where('cargo_waypoints_source.request_id','=' , $requests->id)
        ->get()->toArray();

        /*
        Точки выгрузки
         */
        $requests->waypoints_target = DB::table('cargo_waypoints_target')
        ->leftJoin('_countries', '_countries.country_id', '=', 'cargo_waypoints_target.country')
        ->leftJoin('_regions', '_regions.region_id', '=', 'cargo_waypoints_target.region')
        ->leftJoin('_cities', '_cities.city_id', '=', 'cargo_waypoints_target.city')
        ->select(
            'cargo_waypoints_target.request_id as request_id ',
            '_countries.title_ru as country',
            '_countries.country_id',
            '_regions.title_ru as region',
            '_regions.region_id',
            '_cities.title_ru as city',
            '_cities.city_id',
        )
        ->where('cargo_waypoints_target.request_id','=' , $requests->id)
        ->get()->toArray();
        /*
        Опции по заявке
         */
        $requests->options = DB::table('options_cargo')
        ->leftJoin('options_description', 'options_description.id', '=', 'options_cargo.option_id')
        ->select('options_description.name','options_description.id','options_cargo.value','options_description.type')
        ->where('options_cargo.cargo_request_id','=' , $requests->id)
        ->get()->toArray();
        
        return $requests; 
    }


}
