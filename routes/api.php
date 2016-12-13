<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$router->group(['namespace' => 'Api'], function($router) {
    $router->group(['middleware' => 'auth:api'], function($router) {
        $router->group(['namespace' => 'User', 'prefix' => 'users'], function($router) {
            $router->group(['namespace' => 'Profiles', 'prefix' => 'profiles'], function($router) {
                $router->get('university', 'UniversityProfileController@lists')->name('api.users.profiles.university.lists');
                $router->get('university/{userId}', 'UniversityProfileController@get')->name('api.users.profiles.university.get');
            });
        });

    });
});