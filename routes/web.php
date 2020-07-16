<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');
/*Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get(
	'/contact/all/{id}', 
	'ContactController@single'
)->name('contact-single');

Route::get(
	'/contact/all/{id}/update', 
	'ContactController@update'
)->name('contact-update');

Route::post(
	'/contact/all/{id}/update', 
	'ContactController@updateSubmit'
)->name('contact-update-submit');

Route::get(
	'/contact/all/{id}/delete', 
	'ContactController@deleteSingle'
)->name('contact-delete');

Route::get('/contact/all', 'ContactController@allData')->name('contact-data');
Route::post('/contact/submit', 'ContactController@submit')->name('contact_form');
*/
Auth::routes(['verify' => true ]);

Route::get('/lang/{locale}', 'LocalizationController@index');


Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/send', 'mailController@send');
/*
Route::get('/users', 'PaginationController@users');*/

Route::get('/invite', 'Auth\RegisterController@invite')->name('invite');
Route::post('/inviteStore', 'Auth\RegisterController@inviteStore')->name('inviteSubmit');


Route::resource('add-cargo', 'CargoController')->middleware('verified');

Route::get('/my-company', 'CompanyController@index')->name('my-company')->middleware('verified');
Route::get('/staff', 'WorkersController@index')->name('staff')->middleware('verified');
Route::post('/ajax_invite', 'CompanyController@invite')->name('ajax_invite')->middleware('verified');

//Route::post('/add-cargo-submit', 'CargoController@add-cargo')->name('add-cargo-submit')->middleware('verified');
