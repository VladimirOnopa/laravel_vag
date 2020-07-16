<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Cargo_type extends Model
{
    public function getCargoTypeList()
    {
         return DB::table('cargo_type')
            ->select('*')
            ->get();
    }
}
