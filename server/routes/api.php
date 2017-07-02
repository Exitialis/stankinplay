<?php

Route::group(['namespace' => 'Api'], function($router) {
    $router->group(['namespace' => 'Group', 'prefix' => 'groups'], function($router) {
        $router->get('/', 'GroupController@index')->name('api.groups');
        $router->get('lists', 'GroupController@lists')->name('api.groups.lists');
    });

    $router->group(['namespace' => 'Discipline', 'prefix' => 'disciplines'], function($router) {
        $router->get('/', 'DisciplinesController@index')->name('api.disciplines');
    });

    $router->get('team/lists', 'Team\TeamController@lists')->name('team.lists');

    $router->group(['namespace' => 'News'], function($router) {
        $router->get('news/lists', 'NewsController@lists')->name('api.news.lists');
        $router->get('news/{id}', 'NewsController@get')->name('api.news.get');
        $router->post('news', 'NewsController@create')->name('api.news.create');
        $router->put('news/{id}', 'NewsController@update')->name('api.news.update');
    });

    $router->group(['middleware' => 'auth:api'], function($router) {
        $router->group(['namespace' => 'User',  'prefix' => 'users'], function($router) {
            $router->get('/', 'UserController@index')->name('api.users');
            $router->get('filter', 'UserController@filter')->name('api.users.filter');
            $router->get('{user_id}', 'UserController@find')->name('api.users.find');

            $router->put('{user_id}/roles', 'UserController@attachRole')->name('api.users.roles.attach');
            $router->delete('{user_id}/roles', 'UserController@detachRole')->name('api.users.roles.detach');

            $router->group(['namespace' => 'Profiles', 'prefix' => 'profiles'], function($router) {
                $router->get('university', 'UniversityProfileController@lists')->name('api.users.profiles.university.lists');
                $router->get('university/{userId}', 'UniversityProfileController@get')->name('api.users.profiles.university.get');
                $router->put('university/{profileId}', 'UniversityProfileController@update')->name('api.users.profile.university.update');
            });

            $router->get('{user_id}/permissions', 'PermissionController@get')->name('users.permissions.get');
        });

        $router->group(['namespace' => 'Team'], function($router) {
            $router->get('team', 'TeamController@get')->name('team.get');
            $router->post('team', 'TeamController@store')->name('team.store');
            $router->put('team', 'TeamController@update')->name('team.update');
            $router->get('team/users', 'TeamController@getUsers')->name('team.users.get');
        });

        $router->group(['namespace' => 'Invites'], function($router) {
            $router->get('userInvites', 'InviteController@get')->name('userInvites.get');
            $router->post('invites', 'InviteController@sendInvitation')->name('invites.sendInvite');
            $router->get('invites/{team}', 'InviteController@getTeamInvites')->name('invites.team.get');
            $router->put('invites', 'InviteController@processInvite')->name('invites.process');
        });

    });
});



