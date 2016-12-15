<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Group
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Group whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Group whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Group whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Group extends Model
{
    protected $fillable = ['name'];

    protected $visible = ['id', 'name', 'text'];
}
