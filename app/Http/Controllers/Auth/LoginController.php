<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'login' => 'required|exists:users,login',
            'password' => 'required'
        ]);

        $status = \Auth::attempt([
            'login' => $request->input('login'),
            'password' => $request->input('password')
        ]);

        if ($status) {
            $user = \Auth::user();
            $flash = flash('Авторизация успешно завершена!');
            return response()->json(compact('user', 'flash'));
        }

        return response()->json(flash('При авторизации произошла ошибка', 'error'));
    }
}
