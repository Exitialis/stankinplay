<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Contracts\RoleRepositoryContract;

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

    /**
     * Создание permission для роли.
     *
     * @param $role_id
     * @param $label
     * @param $name
     * @param $route
     *
     * @return Role
     */
    public function createPermission($role_id, $label, $name, $route)
    {
        $role = $this->findOrFail($role_id);

        return $role->permission()->create([
            'label' => $label,
            'name' => $name,
            'route' => $route
        ]);
    }

    /**
     * Проверить, что у роли есть permission.
     *
     * @param $role_id
     * @param $label
     * @return bool
     */
    public function checkPermission($role_id, $label)
    {
        $role = $this->findOrFail($role_id);

        $role = $role->whereHas('permission', function($query) {
            $query->where(compact('label'));
        })->first();

        if ( ! $role) {
            return false;
        }

        return true;
    }

}
