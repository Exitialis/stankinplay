<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\ForgotPost;
use App\Http\Requests\Auth\NewPasswordPost;
use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForgotController extends Controller
{
    public function index()
    {
        return view('auth.forgot');
    }

    public function verify($code)
    {
        $resetPass = ResetPassword::where('code', $code)->first();

        if ( ! $resetPass) {
            abort(404, 'Reset code not found');
        }

        return view('auth.resetPassword', compact('code'));
    }

    /**
     * @param NewPasswordPost $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveNewPassword(NewPasswordPost $request)
    {
        $resetPass = ResetPassword::where('code', $request->input('code'))->with('user')->first();

        $resetPass->confirmed = true;
        $resetPass->save();

        $user = $resetPass->user;

        if ( ! $user) {
            return response()->json(compact(flash('Упс. Кажется, пользователь не найден.', 'error')));
        }

        $user->password = bcrypt($request->input('password'));
        $user->save();

        $redirect = route('login.get');

        notificate(trans('Сброс пароля прошел успешно, теперь вы можете войти в ваш аккаунт.'));

        return response()->json(compact('redirect'));
    }

    public function reset(ForgotPost $request)
    {
        $user = User::where('login', $request->input('login'))->first();
        $code = str_random(32);

        if (ResetPassword::where('user_id', $user->id)->where('confirmed', false)->first()) {

            return response()->json(flash('Невозможно запросить восстановление более чем 1 раз', 'error'), '403');
        }

        $resetPass = new ResetPassword();

        $resetPass->user_id = $user->id;
        $resetPass->code = $code;
        $resetPass->confirmed = false;

        $resetPass->save();

        $link = route('forgot.code', ['code' => $code]);

        \Mail::to($user)->queue(new \App\Mail\ResetPassword($link));

        return response()->json(flash('Успешно!'));
    }
}
