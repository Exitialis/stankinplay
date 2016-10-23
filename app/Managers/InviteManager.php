<?php

namespace App\Managers;

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

        $invite = new UserInvite();
        $invite->inviter_id = $inviter->id;
        $invite->invited_id = $user->id;
        $invite->team_id = $team->id;

        $invite->save();

        return $invite;
    }

}