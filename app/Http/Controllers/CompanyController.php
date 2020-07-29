<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Company;
use App\Models\Workers;
use Validator;
use URL;
use DB;
use Session;



class CompanyController extends Controller
{
    /**
     * Получим данные компании 
     * @return mixed 
     */
    public function index()
    {
        
        $user = auth()->user();
        $comp = new Company();
        $comp = $comp->getCompany($user->id);

        $data = [
            'comp'  => $comp,
            'user'   => $user 
        ];

        return view('my-company', compact('data'));
    }

    /**
     * Создание приглашение в компанию по имейлу
     */
    public function invite(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email',
        ]);
        $comp = new Company();

        if( $comp->ifExistUserByEmail($request->input('email')) ){

            $msg = "Такой email уже зарегистрирован на сайте";

        }else{

            $user = auth()->user();
            $company_id = $comp->getCompany($user->id);

            if($comp->ifExistInvite( $request->input('email')) ){

                $msg = "Приглашение на этот email уже отправленно";

            }else{
                $token = Str::random(30);
                $comp->InviteByEmail( $request->input('email') , $company_id['id'] , $token);

                $to_email = 'wowaonopa1991@gmail.com';
                $data = array('code'=> $token ,'email'=> $request->input('email') , 'url' => URL::to('/') );
                Mail::send('email.email_invite', $data, function($message) use ( $to_email) {
                    $message->to($to_email)->subject('Приглашение в компанию');
                    $message->from('laravel@gmail.com','Приглашение в компанию');
                });

                $msg = "Приглашение отправленно";
            }
            
        }

        return response()->json(array('msg'=> $msg), 200);
    }
    /**
     * Добавим доп телефоны, Viber , Skype , Whatsapp
     */
    public function add_contacts(Request $request)
    {   
        $user = auth()->user();
       
        if($request->has('tel_second')){

            $value = strip_tags($request->input('tel_second'));
            $validator = Validator::make($request->all(), ['tel_second' => 'required|numeric|min:9']);
            if (!$validator->fails()) {
                DB::table('users')->where('id', $user->id)->update(['tel_second' => $value]);
                $msg = "Телефон добавлен!";
            }

        }elseif($request->has('viber')){

            $value = strip_tags($request->input('viber'));
            $validator = Validator::make($request->all(), ['viber' => 'required|min:9']);
            if (!$validator->fails()) {
                DB::table('users')->where('id', $user->id)->update(['viber' => $value]);
                $msg = "Viber добавлен!";
            }

        }elseif($request->has('skype')){

            $value = strip_tags($request->input('skype'));
            $validator = Validator::make($request->all(), ['skype' => 'required|string|min:6']);
            if (!$validator->fails()) {
                DB::table('users')->where('id', $user->id)->update(['skype' => $value]);
                $msg = "Skype добавлен!";
            }

        }elseif($request->has('whatsapp')){

            $value = strip_tags($request->input('whatsapp'));
            $validator = Validator::make($request->all(), ['whatsapp' => 'required|min:9']);
            if (!$validator->fails()) {
               DB::table('users')->where('id', $user->id)->update(['whatsapp' => $value]);
               $msg = "Whatsapp добавлен!";
            }

        }
        if (!$validator->fails()) {
            return redirect()->back()->with('message_add_info_user', $msg);  
        }else{
            return redirect()->back()->withErrors($validator->errors()); 
        }
        
    }
    /**
     * Подтверждение приглашения
     */
    public function acceptInvite()
    {
   
        $request->validate([
            'email' => 'required|email',
        ]);
        
        $comp = new Company();

        if( $comp->checkInviteByEmail($request->input('email')) ){
            $msg = "Такой email уже зарегистрирован на сайте";
        }else{
            $user = auth()->user();
            $company_id = $comp->getCompany($user->id);
            
            $comp->InviteByEmail( $request->input('email') , $company_id['id'] , Str::random(30));
            $msg = "Приглашение отправленно!";
        }
    	
        return response()->json(array('msg'=> $msg), 200);
    }
}
