<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'Api'], function($router) {
    $router->group(['namespace' => 'Group', 'prefix' => 'groups'], function($router) {
        $router->get('/', 'GroupController@index')->name('api.groups');
        $router->get('lists', 'GroupController@lists')->name('api.groups.lists');
    });

    $router->group(['namespace' => 'Discipline', 'prefix' => 'disciplines'], function($router) {
        $router->get('/', 'DisciplinesController@index')->name('api.disciplines');
    });

    $router->group(['middleware' => 'auth:api'], function($router) {
        $router->group(['namespace' => 'User',  'prefix' => 'users'], function($router) {
            $router->get('/', 'UserController@index')->name('api.users');
            $router->get('filter', 'UserController@filter')->name('api.users.filter');
            $router->post('export', 'UserController@export')->name('api.users.export');

            $router->group(['namespace' => 'Profiles', 'prefix' => 'profiles'], function($router) {
                $router->get('university', 'UniversityProfileController@lists')->name('api.users.profiles.university.lists');
                $router->get('university/{userId}', 'UniversityProfileController@get')->name('api.users.profiles.university.get');
                $router->put('university/{profileId}', 'UniversityProfileController@update')->name('api.users.profile.university.update');
            });

        });

    });
});



