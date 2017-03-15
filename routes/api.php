<?php

use App\Mail\ResetPassword;
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

    $router->group(['namespace' => 'Group', 'prefix' => 'groups'], function($router) {
        $router->get('/', 'GroupController@index')->name('api.users.groups');
        $router->get('lists', 'GroupController@lists')->name('api.users.groups.lists');
        $router->get('temp', 'GroupController@temp')->name('api.users.groups.temp');
    });

    $router->group(['namespace' => 'Discipline', 'prefix' => 'disciplines'], function($router) {
        $router->get('/', 'DisciplinesController@index')->name('api.disciplines');
    });

    $router->group(['middleware' => 'auth:api'], function($router) {
        $router->group(['namespace' => 'User', 'prefix' => 'users'], function($router) {
            $router->get('/', 'UserController@index')->name('api.users');
            $router->get('filter', 'UserController@filter')->name('api.users.filter');

            $router->put('{user_id}/roles', 'UserController@attachRole')->name('api.users.roles.attach');
            $router->delete('{user_id}/roles', 'UserController@attachRole')->name('api.users.roles.detach');

            $router->group(['namespace' => 'Profiles', 'prefix' => 'profiles'], function($router) {
                $router->get('university', 'UniversityProfileController@lists')->name('api.users.profiles.university.lists');
                $router->get('university/{userId}', 'UniversityProfileController@get')->name('api.users.profiles.university.get');
                $router->put('university/{profileId}', 'UniversityProfileController@update')->name('api.users.profile.university.update');
            });
        });

    });
});