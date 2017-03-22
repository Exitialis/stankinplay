<?php

/**
 * Авторизация и регистрация.
 */
Route::group(['prefix' => 'auth', 'namespace' => 'Auth', 'middleware' => 'guest'], function (){
    Route::get('registration', 'RegistrationController@index')->name('registration.get');
    Route::post('registration', 'RegistrationController@store')->name('registration.store');
    Route::get('login', 'LoginController@index')->name('login.get');
    Route::post('login', 'LoginController@login')->name('login.post');
    Route::get('forgot', 'ForgotController@index')->name('forgot');
    Route::post('forgot', 'ForgotController@reset')->name('forgot.reset');
    Route::get('forgot/{code}', 'ForgotController@verify')->name('forgot.code');
    Route::post('forgot/save-pass', 'ForgotController@saveNewPassword')->name('forgot.savePass');
});

/**
 * Профиль пользователя.
 */
Route::group(['prefix' => 'user', 'namespace' => 'Profile', 'middleware' => 'auth'], function (){
    Route::get('profile', 'ProfileController@index')->name('profile.get');
    Route::get('logout', 'ProfileController@logout')->name('profile.logout');
});
