<?php

namespace App\Http\Controllers\auth;

use App\Http\Requests\StoreRegistrationPost;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

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
        return view('auth.registration');
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

        $flash = flash(trans('Успешно'));
        $redirect = route('login.get');

        return response()->json(compact('flash', 'redirect'));
    }

}
