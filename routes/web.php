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

Route::group(['midlleware => web'], function (){
	
	Route::get('/auth/registration', 'Auth/RegistrationController@index');
	
	Route::post('/auth/registration', 'Auth/RegistrationController@store');
	
});