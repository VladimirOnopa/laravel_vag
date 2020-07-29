<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\Models\Cargo;
use App\Models\User;
use App\Models\Cargo_type;
use App\Models\Transport_body_type;
use Session;
use Validator;
use DB;



class CargoController extends Controller
{



   public function index()
   {
		$user = auth()->user();
		$cargoList = new Cargo_type();
		$transportType = new Transport_body_type();

		$cargoList = $cargoList->getCargoTypeList();
		$transportType = $transportType->getTransportTypeList(); 
		$payment_moment =  DB::table('payment_moment')->get();
		$payment_type =  DB::table('payment_type')->get();
		$currency =  DB::table('currency')->get();
		$payment_per_type =  DB::table('payment_per_type')->get();
		$options =  DB::table('options_description')->where('type_variant', 'cargo')->orderBy('order_')->orderBy('id')->get();

		$data = [
			'user'=>$user,
			'cargoList'=>$cargoList,
			'transport_type'=>$transportType,
			'payment_moment'=>$payment_moment,
			'payment_type'=>$payment_type,
			'payment_per_type'=>$payment_per_type,
			'currency'=>$currency,
			'options'=>$options,
		];


		return view('Cargo.create-cargo',compact('data'));
   }
   
 	/**
    * Редактирование заявки груза
    * 
    */
   public function edit($id)
   {

		$user = auth()->user();

		if ($user->id === Cargo::find($id)->user_id ) {
   			$cargoList = new Cargo_type();
   			$cargo = new Cargo();
			$transportType = new Transport_body_type();

			$cargoList = $cargoList->getCargoTypeList();
			$transportType = $transportType->getTransportTypeList(); 
			$payment_moment =  DB::table('payment_moment')->get();
			$payment_type =  DB::table('payment_type')->get();
			$currency =  DB::table('currency')->get();
			$payment_per_type =  DB::table('payment_per_type')->get();
			$options =  DB::table('options_description')->where('type_variant', 'cargo')->orderBy('order_')->orderBy('id')->get();
			$cargoRequestData = $cargo->getCargoById($user->id,$id);
			
			$data = [
				'user'=>$user,
				'cargoList'=>$cargoList,
				'transport_type'=>$transportType,
				'payment_moment'=>$payment_moment,
				'payment_type'=>$payment_type,
				'payment_per_type'=>$payment_per_type,
				'currency'=>$currency,
				'options'=>$options,
				'cargoRequestData'=>$cargoRequestData,
			];
			
			return view('Cargo.create-cargo',compact('data'));
		}else{
			abort(404);
		}
		
   }

   public function store(Request $request)
   {
   	
		$validator = Validator::make($request->all(), [ 
			'date_from' => 'required|date',
			'date_to' => 'required|date',
			'cargo_from.1' =>  'required',
			'cargo_from' =>  'nullable|array',
			'cargo_to.1' => 'required',
			'cargo_to' => 'nullable|array',
			'weight' => 'required|integer|min:0',
			'capacity' => 'required|integer|min:0',
			'transport_type' => 'required|integer',
			'cargo_type' => 'required|integer',
			'quantity_transport' => 'required|integer|min:0',
			'gabarit_cargo_length' => 'required|integer|min:0',
			'gabarit_cargo_width' => 'required|integer|min:0',
			'gabarit_cargo_height' => 'required|integer|min:0',
			'price_show' => 'integer',
			'price_amount' => 'nullable|integer',
			'currency' => 'integer',
			'payment_per_type' => 'integer',
			'payment_type' => 'integer',
			'nds' => 'nullable|integer',
			'prepay' => 'nullable|integer',
			'payment_time' => 'integer',
			'tel' => 'required_without:tel_second|string|min:9|max:13',
			'tel_second' => 'required_without:tel|string|min:9|max:13',
			'skype' => 'nullable|string|min:3|max:60',
			'viber' => 'nullable|string|min:9|max:11',
			'whatsapp' => 'nullable|string|min:9|max:11',
			'email' => 'required|email',
			'option' => 'nullable|array',
			'notice' => 'string|nullable|max:500',
		]);

		if (!$validator->fails()) {

			$user = auth()->user();
			$cargo =  new Cargo;

			$options =  array_filter($request->input('option'));
			$cargo_from =  array_values(array_filter($request->input('cargo_from')));//убераем null и сортируем ключи  массива
			$cargo_to =  array_values(array_filter($request->input('cargo_to')));//убераем null и сортируем ключи  массива

			if(count($cargo_from)+count($cargo_to) >8 ){
				return redirect()->back()->withErrors(["max_locations"=>"Максимальное количество пунктов загрузки и/или выгрузки не может превышать 8"]);
			}
			
			$cargo->user_id = $user->id;
			$cargo->tel = strip_tags($request->tel);
			$cargo->tel_second = strip_tags($request->tel_second);
			//$cargo->site_url = strip_tags($request->site_url);
			$cargo->skype = strip_tags($request->skype);
			$cargo->viber = strip_tags($request->viber);
			$cargo->whatsapp = strip_tags($request->whatsapp);
			$cargo->email = strip_tags($request->email);
			$cargo->load_date_from = $request->date_from;
			$cargo->load_date_to = $request->date_to;
			$cargo->body_type = $request->transport_type;
			$cargo->cargo_type = $request->cargo_type;
			$cargo->size_l = $request->gabarit_cargo_length;
			$cargo->size_w = $request->gabarit_cargo_width;
			$cargo->size_h = $request->gabarit_cargo_height;
			$cargo->weight_max = $request->weight;
			$cargo->capacity = $request->capacity;
			$cargo->quantity_transport = $request->quantity_transport;
			$cargo->price_show = $request->price_show;
			$cargo->payment_type = $request->payment_type;
			$cargo->nds = $request->nds;
			$cargo->price_amount = $request->price_amount;
			$cargo->currency = $request->currency;
			$cargo->prepay = $request->prepay;
			$cargo->per_type = $request->per_type;
			$cargo->payment_time = $request->payment_time;
			$cargo->notice = strip_tags($request->notice);
			$cargo->created_at = date('Y-m-d H:i:s');
			$cargo->refresh_at = date('Y-m-d H:i:s');
			$cargo->save();

			/*Инсертим маршрут загрузки*/			
			foreach ($cargo_from as $order_key => $point) {
				$isRegion = DB::table('_regions')->select('_regions.country_id')->where('region_id', $point)->first();
				
				if(!empty($isRegion) && $isRegion != NULL){//если область
					DB::table('cargo_waypoints_source')->insert(
					    ['request_id' => $cargo->id, 'country' => $isRegion->country_id, 'region' => $point ,'city' => NULL , 'order'=>$order_key]
					);
				}else{//если город
					$isCity = DB::table('_cities')->select('_cities.country_id' , '_cities.region_id')->where('city_id', $point)->first();
					DB::table('cargo_waypoints_source')->insert(
					    ['request_id' => $cargo->id, 'country' => $isCity->country_id, 'region' => $isCity->region_id ,'city' => $point , 'order'=>$order_key]
					);
				}				
			}
			/*Инсертим маршрут выгрузки*/			
			foreach ($cargo_to as $order_key => $point) {
				$isRegion = DB::table('_regions')->select('_regions.country_id')->where('region_id', $point)->first();
				
				if(!empty($isRegion) && $isRegion != NULL){//если область
					DB::table('cargo_waypoints_target')->insert(
					    ['request_id' => $cargo->id, 'country' => $isRegion->country_id, 'region' => $point ,'city' => NULL , 'order'=>$order_key]
					);
				}else{//если город
					$isCity = DB::table('_cities')->select('_cities.country_id' , '_cities.region_id')->where('city_id', $point)->first();
					DB::table('cargo_waypoints_target')->insert(
					    ['request_id' => $cargo->id, 'country' => $isCity->country_id, 'region' => $isCity->region_id ,'city' => $point , 'order'=>$order_key]
					);
				}				
			}
			/*Инсертим опции заявки*/
			if(!empty($options)){
				foreach ($options as $key => $option) {
					DB::table('options_cargo')->insert(
					    ['cargo_request_id' => $cargo->id, 'option_id' => $key, 'value' => $option]
					);
				}
			}

			Session::flash('success',trans('cargo.success_add'));
       		return redirect()->route('my-cargos'); 
			
		}else{	
       		return redirect()->back()->withErrors($validator->errors());
		}

   }

    /**
    * Удаление заявки на стр. заявок пользователя
    * 
    */
   public function destroy ($id)
   {

		$user = auth()->user();

		if ($user->id === Cargo::find($id)->user_id ) {
			DB::table('cargo_request')->where('id', '=', $id)->delete();

			Session::flash('success_remove',trans('cargo.success_remove'));
			return redirect()->back();
		}else{
			abort(404);
		}
   }

    /**
    * Страница списока АКТИВНЫХ грузов пользователя
    * 
    */
   public function my_cargos()
   {
   	   

   		$active = 1;
		$user = auth()->user();
		$cargosList = new Cargo();
		$cargosList = $cargosList->getAllCargoUser($user->id,$active);
		
		if(empty($cargosList)){
			$data = ['empty'=>true];
		}else{
			$data = ['cargosList'=>$cargosList];
		}


		
		return view('Cargo.my-cargos',compact('data'));	
   }

   /**
    * Страница списока АРХИВА грузов пользователя
    * 
    */
   public function my_cargos_archive()
   {
   		$active = 0;
		$user = auth()->user();
		$cargosList = new Cargo();
		$cargosList = $cargosList->getAllCargoUser($user->id,$active);
		
		if(empty($cargosList)){
			$data = ['empty'=>true];
		}else{
			$data = ['cargosList'=>$cargosList];
		}
		return view('Cargo.my-cargos-archive',compact('data'));	
   }
   public function update(Request $request)
   {
	//dd($request);
   }

   /**
    * Обновляем время размещения заявки
    * 
    */
   public function refresh_request($id)
   {
	 	$user = auth()->user();

		if ($user->id === Cargo::find($id)->user_id ) {
			DB::table('cargo_request')->where('id', $id)->update(['refresh_at' => date('Y-m-d H:i:s') , 'active' => 1]);

			Session::flash('success_update',trans('cargo.success_update'));
			return redirect()->route('my-cargos');
		}else{
			abort(404);
		}
   }

   /**
    * Помещаем заявку груза в архив
    * 
    */
   public function deactivate_request($id)
   {
	 	$user = auth()->user();

		if ($user->id === Cargo::find($id)->user_id ) {
			DB::table('cargo_request')->where('id', $id)->update(['active' => 0 ]);

			Session::flash('success_deactivate',trans('cargo.success_deactivate'));
			return redirect()->back();
		}else{
			abort(404);
		}
   }

   

}
