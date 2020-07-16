<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Company;
use App\Models\Workers;
use URL;



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
