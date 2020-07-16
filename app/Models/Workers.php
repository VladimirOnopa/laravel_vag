<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Workers extends Model
{
    /**
     * Определяет необходимость отметок времени для модели.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'company_workers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'company_id',  'is_admin'
    ];


    /**
     * [get all workers]
     * @param  [int] $company_id [company_id id]
     * @return [mixed]          [list workers]
     */
    public function getWorkers($company_id)
    {

        $workers = DB::table('users')
                    ->select('company_workers.is_admin' ,'users.name', 'users.id' , 'users.surname' , 'users.tel' , 'users.skype' , 'users.viber' , 'users.whatsapp' , 'users.email' , 'users.last_active', 'users.register_date')
                    ->leftJoin('company_workers', 'company_workers.user_id', '=', 'users.id')
                    ->where('company_workers.company_id','=' , $company_id)
                    ->get();
                   
        return $workers;
    }


    
}
