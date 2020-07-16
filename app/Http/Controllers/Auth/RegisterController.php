<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Company;
use App\Models\Workers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {
        Session::flash('success',trans('auth.registered'));
        return route('home');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|alpha|max:50|min:2',
            'surname' => 'required|alpha|max:50|min:2',
            'tel' => 'required|numeric', 
            'user_type' => 'required',
            'email' => 'required|string|email|max:60|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

    }
     /**
     * Проверка валидности передаваемых данных через URL
     * @param  Request $request 
     * @return view 
     */
    protected function invite(Request $request)
    {

        $data = $request->query();
        $exist = DB::table('invites')
            ->select('invites.company_id')
            ->where([['invites.email_to','=',$data['e']],['invite_сode','=', $data['s']]])
            ->first();

        if($exist){
            return view('auth.invite-register', ['signature' => $data['s'],'email' => $data['e']]);
        }else{
           abort(404); 
        }
        
    }
    /**
     * Обработка данных с формы регистрации invite-register 
     * @param  Request $request 
     * @return view 
     */
    protected function inviteStore(Request $request)
    {

        $v = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'tel' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }else{

            $exist = DB::table('invites')
            ->select('invites.company_id')
            ->where([['invites.email_to','=',$request->email],['invite_сode','=', $request->s]])
            ->first();
            if($exist){

                $user = User::create([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'tel' => $request->tel,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'email_verified_at' => date('Y-m-d h:i:s'),
                    'register_date' => date('Y-m-d h:i:s'),
                    'last_active' => date('Y-m-d h:i:s'),
                ]);
                //Добавим пользователя в список сотрудников  с ролью сотрудника
                Workers::create([
                    'user_id' => $user->id,
                    'company_id' => $exist->company_id,
                    'is_admin' => 0,
                ]);
                Auth::login($user);

                DB::table('invites')->where([['invites.email_to','=',$request->email],['invite_сode','=', $request->s]])->delete();

                session()->flash('success', 'Вы успешно зарегистрированы!');

                return redirect()->route('home');
            }

        }
         
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'register_date' => date('Y-m-d H:i:s'),
            'last_active' => date('Y-m-d H:i:s'),
            'user_access_type' => 1,
            'user_type' => $data['user_type'],
        ]);
         /*
        Создадим компанию и добавим туда пользователя как админа
         */
        $company = Company::create([
            'user_id' => $user->id,
            'company_name' => $data['name'].' '.$data['surname'],
            'created_at' => date('Y-m-d H:i:s'),
            'verified' => 0,
        ]);
        /*
        Добавим пользователя в список сотрудников компании как админа
         */
        Workers::create([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'is_admin' => 1,
        ]);

        return $user;
    }
}
