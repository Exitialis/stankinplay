<?php

Route::group(['prefix' => 'auth', 'namespace' => 'Auth', 'middleware' => 'guest'], function (){
        Route::get('registration', 'RegistrationController@index')->name('registration.get');
        Route::post('registration', 'RegistrationController@store')->name('registration.store');

        Route::get('login', 'LoginController@index')->name('login.get');
        Route::post('login', 'LoginController@login')->name('login.post');
});

Route::group(['prefix' => 'user', 'namespace' => 'User', 'middleware' => 'auth'], function (){
    Route::get('profile', 'ProfileController@index')->name('profile.get');
    Route::get('logout', 'ProfileController@logout')->name('profile.logout');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Team'], function() {
    Route::get('team', 'TeamController@index')->name('team.get');
    Route::post('team', 'TeamController@store')->name('team.store');
});

Route::get('/', function() {
    return redirect()->route('profile.get');
});

