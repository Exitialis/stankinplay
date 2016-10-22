<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * App\User
 *
 * @property-read \App\Models\Team $team
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $team_id
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $group
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereTeamId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereMiddleName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    protected $guarded = [];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }
}
