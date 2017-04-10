<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
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
 * @property integer $discipline_id
 * @property-read \App\Models\Discipline $discipline
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDisciplineId($value)
 * @property-read \App\Models\Team $ownTeam
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserInvite[] $invites
 * @property-read \App\Models\UniversityProfile $universityProfile
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read mixed $full_name
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable, EntrustUserTrait;

    protected $appends = ['full_name'];

    protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at'];

    protected $visible = ['id', 'login', 'email', 'first_name', 'last_name', 'middle_name', 'full_name',  'team', 'discipline', 'ownTeam', 'invites', 'universityProfile', 'roles', 'name'];

    public $exportedAttributes = [
        'login' => 'Никнейм',
        /*'last_name' => 'Фамилия',
        'first_name' => 'Имя',
        'middle_name' => 'Отчество',*/
        'full_name' => 'ФИО',
        'discipline' => 'Дисциплина',
    ];

    protected $guarded = [];

    /**
     * ФИО пользователя.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name . ' ' . $this->middle_name;
    }

    public function team()
    {
        return $this->belongsToMany(Team::class, 'user_team');
    }

    public function discipline()
    {
        return $this->belongsToMany(Discipline::class, 'user_discipline');
    }

    public function ownTeam()
    {
        return $this->hasOne(Team::class, 'captain_id');
    }

    /**
     * Имеет приглашения в команду.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invites()
    {
        return $this->hasMany(UserInvite::class, 'invited_id');
    }

    /**
     * Профиль в вузе.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function universityProfile()
    {
        return $this->hasOne(UniversityProfile::class);
    }
}
