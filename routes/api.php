<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'Api'], function($router) {
    $router->group(['namespace' => 'Group', 'prefix' => 'groups'], function($router) {
        $router->get('/', 'GroupController@index')->name('api.users.groups');
        $router->get('lists', 'GroupController@lists')->name('api.users.groups.lists');
        $router->get('temp', 'GroupController@temp')->name('api.users.groups.temp');
    });
});


