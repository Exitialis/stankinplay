<?php

namespace App\Repositories\Contracts;

interface UserRepositoryContract extends BaseRepositoryContract
{
    public function saveUser($login, $email, $pass, $firstName, $lastName, $middleName, $group);
}