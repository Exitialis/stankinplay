<?php

namespace App\Repositories;

use App\Repositories\Contracts\RoleRepositoryContract;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;

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
     * @param $role
     * @param $label
     * @param $name
     * @param $route
     * @return Model
     */
    public function createPermission($role, $label, $name, $route)
    {
        $role = $this->getRole($role);

        return $role->permission()->create([
            'label' => $label,
            'name' => $name,
            'route' => $route
        ]);
    }

    public function checkPermission($role, $label)
    {
        $role = $this->getRole($role);

        $role = $role->whereHas('permission', function($query) {
            $query->where(compact('label'));
        })->first();

        if ( ! $role) {
            return false;
        }

        return true;
    }

    protected function getRole($role)
    {
        if ( ! $role instanceof Model) {
            return $this->find($role);
        }

        return $role;
    }
}
