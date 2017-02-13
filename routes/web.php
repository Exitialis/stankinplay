<?php

use App\Models\Discipline;

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

Route::group(['prefix' => 'admin', 'middleware' => 'role:admin|moderator', 'namespace' => 'Admin'], function() {
    Route::get('/', 'MainController@index')->name('admin');
    Route::get('users', 'UsersController@index')->name('admin.users');
    //Route::get('tournament', 'TournamentController@index')->name('admin.tournament');
});

Route::get('disciplines', function() {
    return Discipline::select('id', 'name')->get();
});

Route::post('permission-check', 'Permissions\PermissionController@can');

Route::get('/', function() {
    return redirect()->route('profile.get');
})->name('home');

//Route::get('menu', 'Menu\TopMenuController@get')->name('menu.get');

