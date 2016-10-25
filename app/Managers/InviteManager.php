<?php

namespace App\Managers;

use App\Models\InviteUserStatus;
use App\Models\Team;
use App\Models\User;
use App\Models\UserInvite;

class InviteManager
{
    /**
     * Получить инвайты пользователя.
     *
     * @return bool|mixed
     */
    public function getUserInvites()
    {
        if ( ! $user = \Auth::user()) {
            return false;
        }

        return $user->invites;
    }

    /**
     * Получить приглашения команды.
     *
     * @param Team $team
     * @return mixed
     */
    public function getTeamInvites($team)
    {
        if ( !  $team instanceof Team) {
            $team = Team::findOrFail($team);
        }

        return $team->invites()->with(['status', 'inviter', 'invited'])->get();
    }

    /**
     * Пригласить пользователя в команду.
     *
     * @param $team_id
     * @param $user_id
     * @return UserInvite|bool
     */
    public function inviteUser($team_id, $user_id)
    {
        if ( ! $inviter = \Auth::user()) {
            return false;
        }

        $user = User::findOrFail($user_id);
        $team = Team::findOrFail($team_id);
        $status = InviteUserStatus::where('status', 'sended')->first();

        $invite = new UserInvite();
        $invite->inviter_id = $inviter->id;
        $invite->invited_id = $user->id;
        $invite->team_id = $team->id;
        $invite->status_id = $status->id;

        $invite->save();

        return $invite;
    }

}