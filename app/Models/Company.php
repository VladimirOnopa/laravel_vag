<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Response;


class Company extends Model
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
    protected $table = 'company';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'company_name',  'created_at','verified'
    ];


    public function admin()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function workers()
    {
        return $this->hasMany('App\Models\Workers');
    }
    /**
     * Получим инфу компании
     * @param  [int] $user_id [user id]
     * @return [mixed]          [cpmpany info]
     */
    public function getCompany($user_id)
    {

        $company = Company::select('company.*')
                    ->leftJoin('company_workers', 'company_id', '=', 'company.id')
                    ->where('company_workers.user_id','=' , $user_id)
                    ->first();

        return $company->getAttributes();
    }

    /**
     * Проверим есть ли юзер в таблице user
     */
    public function ifExistUserByEmail($email)
    {
        return DB::table('users')
            ->select('users.email')
            ->where('users.email','=' , $email)
            ->first();
    }
    /**
     * Проверим есть ли юзер в таблице invites
     */
    public function ifExistInvite($email)
    {
        return DB::table('invites')
            ->select('invites.email_to')
            ->where('invites.email_to','=' , $email)
            ->first();
    }

    /**
     * Добавить приглашение в талибцу invites
     */
    public function InviteByEmail($email,$company_id,$rand)
    {
       
        DB::table('invites')->insert(
            ['company_id' => $company_id, 'email_to' => $email, 'invite_сode' => $rand, 'created_at' => date('Y-m-d h:m;s')]
        );

    }




}
