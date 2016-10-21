<?php

namespace App\Http\Controllers\auth;

use App\Http\Requests\StoreRegistrationPost;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{

    /**
     * Репозиторий пользователей.
     *
     * @var UserRepositoryContract
     */
    protected $users;

    /**
     * RegistrationController constructor.
     * @param $users
     */
    public function __construct(UserRepositoryContract $users)
    {
        $this->users = $users;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $auth = Auth::guard()->check();

        return view('auth.registration', compact('auth'));
    }

    /**
     * Регистрация пользователя.
     *
     * @param StoreRegistrationPost $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRegistrationPost $request)
    {
        $user = $this->users->saveUser($request);

        if ( ! $user) {
            return response()->json(flash(trans('Произошла ошибка', 'error')));
        }

        $redirect = route('login.get');

        notificate(trans('Регистрация прошла успешно, теперь вы можете войти в аккаунт'));
        
        return response()->json(compact('redirect'));
    }

}
