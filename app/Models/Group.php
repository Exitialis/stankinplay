<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $attributes = ['name'];

    protected $fillable = ['name'];

    protected $visible = ['name'];
}
