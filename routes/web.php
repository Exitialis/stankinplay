<?php

Route::get('home', function() {
	return view('test');
});

Route::get('test', 'HomeController@test');
Route::post('test', 'HomeController@testReq');

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function (){

    Route::get('registration', 'RegistrationController@index')->name('registration.get');
	Route::post('registration', 'RegistrationController@store')->name('registration.store');
	Route::get('login', 'LoginController@index')->name('login.get');
	Route::post('login', 'LoginController@login')->name('login.post');
});