<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class Pagination extends Controller
{
     public function users()
    {
    	$users = User::all();

    	return view('pagination',$users);
    }
}
