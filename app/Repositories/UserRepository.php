<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryContract;
use App\User;
use Exitialis\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    /**
     * Установить модель для работы с ней.
     *
     * @return mixed
     */
    public function model()
    {
        return User::class;
    }

}