<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use App\Models\Company;


class User extends Authenticatable implements MustVerifyEmail
{
    public $timestamps = false;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname',  'user_access_type','user_type', 'email', 'last_active',  'register_date','email_verified_at', 'tel', 'user_type', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_active' => 'datetime',
    ];
 
    public function cargoList()
    {
        return $this->hasMany('App\Models\Cargo');
    }

    public function company()
    {
        return $this->hasOne('App\Models\Company');
    }
    /**
     * [is_admin Если текущий пользователь администратор компании]
     * @param  [int]  $user_id 
     * @return boolean  [возвращает 0 или 1 ]
     */
    public function isCurrenUserAdmin($user_id)
    {
       return DB::table('company_workers')
                ->select('company_workers.is_admin')
                ->where('company_workers.user_id','=' , $user_id)
                ->first();
    }

}
