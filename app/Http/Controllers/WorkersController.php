<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use App\Models\Workers;
use Carbon\Carbon;

class WorkersController extends Controller
{
   	public function index()
    {
    	/*
    	Получить компанию
    	 */
    	$user = auth()->user();
    	$comp = new Company();
        $comp = $comp->getCompany($user->id);

        /*
    	Получить сотрудников
    	 */
    	$workers = new Workers();

        $workers = $workers->getWorkers($comp['id']);
        $is_admin = $user->isCurrenUserAdmin($user->id);
        $workersLimit = 5; //лимит сотрудников



        if(count($workers) == $workersLimit){
            $overLimit = true; 
        }else{
            $overLimit = false; 
        }
        
        $data = [
		    'workers'  => $workers,
            'is_admin'   => $is_admin->is_admin ,
		    'overLimit'   => $overLimit
		];


        return view('workers', compact('data'));
    }
}


