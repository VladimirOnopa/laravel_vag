<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use  App\Models\Contact;

class ContactController extends Controller
{ 
    public function submit(ContactRequest $data){
    	//dd($data->input('email'));

    	/*$valid = $data->validate([
			'email' => 'required',
			'name' => 'min:5'
    	]);*/

    	$contact = new Contact();

    	$contact->name = $data->input('name');
    	$contact->email = $data->input('email');
    	$contact->message = $data->input('message');

    	$contact->save();

    	return redirect()->route('home')->with('success','Добавленно') ;

    }
    public function allData(){
        $contact = new Contact;
        //$contact->orderBy('id','DESC')->skip(1)->take(1)->get()
        return view('messages',['data' => $contact->all()]);
    }
    public function single($id){
        $contact = new Contact;
        return view('single',['data' => $contact->find($id)]);
    }
    public function update($id){
        $contact = new Contact;
        return view('update-single',['data' => $contact->find($id)]);
    }
    public function updateSubmit($id , ContactRequest $data){
        
        $contact = Contact::find($id);

        $contact->name = $data->input('name');
        $contact->email = $data->input('email');
        $contact->message = $data->input('message');

        $contact->save();

        return redirect()->route('contact-single',$id)->with('success','Обновленно') ;
    }
    public function deleteSingle($id){
        $contact = Contact::find($id)->delete();
        return view('messages')->with('success','Удалено');
    }
}
  