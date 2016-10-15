<?php

Route::get('home', function() {
	return view('test');
});

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function (){

    Route::get('registration', 'RegistrationController@index')->name('registration.get');
	Route::post('registration', 'RegistrationController@store')->name('registration.store');
	
});