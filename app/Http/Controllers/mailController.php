<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\mail\newMail
class mailController extends Controller
{
    public function send(){
    	Mail::send(new Mail);
    }

    public function email(){
    	return view( view: 'email');
    }
}
 