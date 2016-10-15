<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;

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
     * @param $login
     * @param $email
     * @param $pass
     * @param $firstName
     * @param $lastName
     * @param $middleName
     * @param $group
     *
     * @return User
     */
    public function saveUser($login, $email, $pass, $firstName, $lastName, $middleName, $group)
    {
        return $this->create([
            'login' => $login,
            'email' => $email,
            'password' => $pass,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'middle_name' => $middleName,
            'group' => $group
        ]);
    }

}