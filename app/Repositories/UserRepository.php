<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Http\Request;

class UserRepository extends BaseRepository implements UserRepositoryContract
{

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Создать нового пользователя.
     *
     * @param Request $request
     * @return User
     */
    public function saveUser(Request $request)
    {
        return $this->create([
            'login' => $request->input('login'),
            'email' => $request->input('email'),
            'password' => $request->input('pass'),
            'first_name' => $request->input('firstName'),
            'last_name' => $request->input('lastName'),
            'middle_name' => $request->input('middleName'),
            'group' => $request->input('group')
        ]);
    }

}