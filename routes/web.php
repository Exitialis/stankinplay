<?php

Route::get('/', function() {
   return redirect()->to('profile');
})->name('home');

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

Route::group(['middleware' => 'auth'], function() {
    Route::group(['namespace' => 'Team'], function() {
        Route::get('team', 'TeamController@get')->name('team.get');
        Route::post('team', 'TeamController@store')->name('team.store');
        Route::put('team', 'TeamController@update')->name('team.update');
    });
    Route::group(['namespace' => 'Invites'], function() {
        Route::get('invites', 'InviteController@get')->name('invites.get');
        Route::post('invites', 'InviteController@sendInvitation')->name('invites.sendInvite');
        Route::get('invites/{team}', 'InviteController@getTeamInvites')->name('invites.team.get');
        Route::put('invites', 'InviteController@processInvite')->name('invites.process');
    });
    Route::group(['namespace' => 'Users'], function() {
        Route::get('users', 'UserController@get');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => 'role:admin|discipline_head', 'namespace' => 'Admin'], function() {
    Route::get('/', 'MainController@index')->name('admin');
    Route::get('users', 'UsersController@index')->name('admin.users');
    Route::get('users/{user}', 'UsersController@show')->name('admin.users.user');
    //Route::get('tournament', 'TournamentController@index')->name('admin.tournament');
});

Route::post('permission-check', 'Permissions\PermissionController@can');

