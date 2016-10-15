<?php

namespace App\Repositories;

use App\Repositories\Contracts\RoleRepositoryContract;
use App\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryContract
{
    /**
     * RoleRepository constructor.
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->model = $role;
    }
}
