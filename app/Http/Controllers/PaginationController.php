<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class PaginationController extends Controller
{
     public function users()
    {
    	$users = User::paginate(2);
    	return view('pagination', ['users' =>$users]);
    }
}
