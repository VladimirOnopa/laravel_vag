<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
		'license',
		'adr',
		'quantity_transport',
		'price_show',
		'payment_type',
		'price_amount',
		'nds',
		'currency',
		'per_type',
		'options',
		'prepay',
		'payment_time',
		'notice',
		'created_at', 
		'refresh_at'
    ];

    public function getCargo($user_id)
    {
        return DB::table('cargo_request')
            ->select('cargo_request.*')
            ->where('cargo_request.user_id','=' , $user_id)
            ->first();
    }


}
