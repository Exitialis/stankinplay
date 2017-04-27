<?php

Route::get('/', function() {
   return redirect()->route('profile.get');
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

Route::post('export', 'Api\User\UserController@export')->name('api.users.export');

/**
 * Профиль пользователя.
 */
Route::group(['prefix' => 'user', 'namespace' => 'Profile', 'middleware' => 'auth'], function (){
    Route::get('profile', 'ProfileController@index')->name('profile.get');
    Route::get('profile/team', 'ProfileController@team')->name('profile.team');
    Route::get('logout', 'ProfileController@logout')->name('profile.logout');
});

Route::group(['prefix' => 'news', 'namespace' => 'News'], function($router) {
    $router->get('/', 'NewsController@index')->name('news');
});

//Страница с командами
Route::group(['prefix' => 'team', 'namespace' => 'Team'], function() {
    Route::get('/', 'TeamController@index')->name('team');
});

Route::group(['prefix' => 'admin', 'middleware' => 'role:admin|discipline_head', 'namespace' => 'Admin'], function() {
    Route::get('/', 'MainController@index')->name('admin');
    Route::get('users', 'UsersController@index')->name('admin.users');
    Route::get('users/{user}', 'UsersController@show')->name('admin.users.user');
    //Route::get('tournament', 'TournamentController@index')->name('admin.tournament');
});

Route::post('permission-check', 'Permissions\PermissionController@can');

