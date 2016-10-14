<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use Illuminate\Http\Request;

Route::get('home', function() {
	return view('test');
});

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function (){

    Route::get('registration', 'RegistrationController@index');
	Route::post('registration', 'RegistrationController@store');
	
});