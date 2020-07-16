<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Transport_body_type extends Model
{
    public function getTransportTypeList()
    {
         return DB::table('transport_body_type')
            ->select('*')
            ->get();
    }
}
