<?php

Route::group(['prefix' => 'auth', 'namespace' => 'Auth', 'middleware' => 'guest'], function (){
    Route::get('registration', 'RegistrationController@index')->name('registration.get');
    Route::get('login', 'LoginController@index')->name('login.get');
    Route::get('forgot', 'ForgotController@index')->name('forgot');
    Route::post('forgot', 'ForgotController@reset')->name('forgot.reset');
    Route::get('forgot/{code}', 'ForgotController@verify')->name('forgot.code');
    Route::post('forgot/save-pass', 'ForgotController@saveNewPassword')->name('forgot.savePass');
});

