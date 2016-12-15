<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Team
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $user
 * @property-read \App\Models\Discipline $discipline
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $discipline_id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereDisciplineId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereUpdatedAt($value)
 * @property integer $captain_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereCaptainId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $members
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserInvite[] $invites
 * @property-read \App\Models\User $captain
 */
class Team extends Model
{

    protected $guarded = [];

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function invites()
    {
        return $this->hasMany(UserInvite::class);
    }

    /**
     * Создатель команды, он же - капитан.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function captain()
    {
        return $this->belongsTo(User::class, 'captain_id');
    }
}
