<?php

namespace App\Http\Controllers\Menu;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TopMenuController extends Controller
{
    /**
     * Получить пункты меню.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        $routes = [
            [
                'route' => route('login.get'),
                'name' => 'Войти'
            ],
            [
                'route' => route('registration.get'),
                'name' => 'Зарегистрироваться'
            ],
            [
                'route' => route('profile.get'),
                'name' => 'Профиль'
            ],
            [
                'route' => route('profile.logout'),
                'name' => 'Выйти'
            ]
        ];

        return response()->json($routes);
    }
}
