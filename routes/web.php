<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');

Auth::routes(['verify' => true ]);

Route::get('/lang/{locale}', 'LocalizationController@index');


Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/invite', 'Auth\RegisterController@invite')->name('invite');
Route::post('/inviteStore', 'Auth\RegisterController@inviteStore')->name('inviteSubmit');

////////Cargo
///
Route::resource('cargo', 'CargoController')->middleware('verified');
Route::get('/refresh_request/{id}', 'CargoController@refresh_request')->middleware('verified');
Route::get('/deactivate_request/{id}', 'CargoController@deactivate_request')->middleware('verified');
Route::get('/my-cargos', 'CargoController@my_cargos')->name('my-cargos')->middleware('verified');
Route::get('/my-cargos-archive', 'CargoController@my_cargos_archive')->name('my-cargos-archive')->middleware('verified');

Route::get('/staff', 'WorkersController@index')->name('staff')->middleware('verified');

////////Company
///
Route::get('/my-company', 'CompanyController@index')->name('my-company')->middleware('verified');
Route::post('/ajax_invite', 'CompanyController@invite')->name('ajax_invite')->middleware('verified');
Route::post('/add_tel_second', 'CompanyController@add_contacts')->name('add_tel_second')->middleware('verified');
Route::post('/add_viber', 'CompanyController@add_contacts')->name('add_viber')->middleware('verified');
Route::post('/add_skype', 'CompanyController@add_contacts')->name('add_skype')->middleware('verified');
Route::post('/add_whatsapp', 'CompanyController@add_contacts')->name('add_whatsapp')->middleware('verified');

Route::post('/ajax_search_location', 'HomeController@ajax_search_location')->name('ajax_search_location')->middleware('verified');

//Route::post('/add-cargo-submit', 'CargoController@add-cargo')->name('add-cargo-submit')->middleware('verified');
