<?php

namespace App\Repositories;

use App\Repositories\Contracts\PermissionRepositoryContract;
use App\Models\Permission;

class PermissionRepository extends BaseRepository implements PermissionRepositoryContract
{
    /**
     * PermissionRepository constructor.
     * @param Permission $permission
     */
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }
}
