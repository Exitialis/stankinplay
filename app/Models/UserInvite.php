<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserInvite
 *
 * @property integer $id
 * @property integer $invited_id
 * @property integer $inviter_id
 * @property integer $team_id
 * @property integer $status_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $inviter
 * @property-read \App\Models\User $invited
 * @property-read \App\Models\Team $team
 * @property-read \App\Models\InviteUserStatus $status
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserInvite whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserInvite whereInvitedId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserInvite whereInviterId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserInvite whereTeamId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserInvite whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserInvite whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserInvite whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserInvite extends Model
{
    public function inviter()
    {
        return $this->belongsTo(User::class, 'inviter_id');
    }

    public function invited()
    {
        return $this->belongsTo(User::class, 'invited_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function status()
    {
        return $this->belongsTo(InviteUserStatus::class, 'status_id');
    }
}
