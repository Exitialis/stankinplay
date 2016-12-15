<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Discipline
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discipline whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discipline whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discipline whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discipline whereUpdatedAt($value)
 * @property string $label
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discipline whereLabel($value)
 * @property boolean $team
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discipline whereTeam($value)
 */
class Discipline extends Model
{
    //
}
