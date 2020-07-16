<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\User;
use App\Models\Cargo_type;
use App\Models\Transport_body_type;
use Validator;


class CargoController extends Controller
{



   public function index()
   {
   	$user = auth()->user();
      $cargoList = new Cargo_type();
      $transportType = new Transport_body_type();
      $cargoList = $cargoList->getCargoTypeList();
      $transportType = $transportType->getTransportTypeList();
      $data = [
         'user'=>$user,
         'cargoList'=>$cargoList,
         'transport_type'=>$transportType,
      ];


   	return view('Cargo.create-cargo',compact('data'));
   }


   public function create()
   {
   
      $user = auth()->user();
      $cargo = User::find($user->id)->cargoList;

      return view('Cargo.create-cargo',compact('cargo'));
   }

   public function store(Request $request)
   {
   	

      $validator = Validator::make($request->all(), [ // <---
         'date_from' => 'required|date',
         'date_to' => 'required|date',
         'cargo_from.1' =>  'required',
         'cargo_from' =>  'present|array',
         'cargo_to' => 'present|array',
         'weight' => 'required|integer|min:0',
         'size' => 'required|integer|min:0',
         'price' => 'required|integer',
         'transport_type' => 'required|integer',
         'transport_count' => 'required|integer|min:0',
         'gabarit_cargo_length' => 'required|integer|min:0',
         'gabarit_cargo_width' => 'required|integer|min:0',
         'gabarit_cargo_height' => 'required|integer|min:0',
         'company_name' => 'required',
         'company_name_client' => 'required',
         'tel' => 'required',
         'email' => 'required|email',
        ]);
      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator->errors());
      } else{
        echo "sss";
      }
      
   	//return view('Cargo.create-cargo');
   }


   public function update(Request $request)
   {
	//dd($request);
   }
}
