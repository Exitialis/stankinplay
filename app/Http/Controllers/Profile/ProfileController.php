<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;

use App\Repositories\Contracts\UserRepositoryContract;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
     * Страница профиля пользователя.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('profile.main');
    }

    /**
     * Выход пользователя.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function logout(){
        Auth::logout();

        return view('auth.login');
    }

    /**
     * Получить страницу с командой пользователя.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function team()
    {
        return view('profile.team.index');
    }

    public function game()
    {
        return view('profile.game.index');
    }

}
