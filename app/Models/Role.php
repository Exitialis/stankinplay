<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_role', 'user_id', 'role_id');
    }

}
