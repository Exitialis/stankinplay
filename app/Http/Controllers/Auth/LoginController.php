<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $auth = Auth::guard()->check();
        return view('auth.login' ,compact('auth'));
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
            $flash = flash(trans('Авторизация успешно завершена!'));
            $redirect = route('profile.get');
            return response()->json(compact('user', 'flash', 'redirect'));
        }

        return response()->json(flash('При авторизации произошла ошибка', 'error'));
    }
}
