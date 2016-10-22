<?php

namespace App\Managers;

use App\Models\Role;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AuthManager
{
    /**
     * Репозиторий пользователей.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * UserManager constructor.
     */
    public function __construct()
    {
        $this->users = app(UserRepositoryContract::class);
    }

    /**
     * Зарегистрировать пользователя.
     *
     * @param Request $request
     * @return bool
     */
    public function register(Request $request)
    {
        $user = $this->users->saveUser($request);

        if ( ! $user) {
            return false;
        }

        if ($request->has('captain')) {
            if ( ! $captain = Role::where('name', 'captain')->firstOrFail()) {
                $user->delete();
                return false;
            }

            $user->attachRole($captain);
        }

        return $user;
    }


}