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

        return $user->invites()->whereHas('status', function($query) {
            $query->where('status', 'sended');
        })->with(['inviter', 'team'])->get();
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

        if ( UserInvite::where('team_id', $team_id)->where('invited_id', $user_id)->first() ) {
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

    /**
     * Принять приглашение в команду.
     *
     * @param $invite
     * @return User|bool|null
     */
    public function acceptInvite($invite)
    {
        if ( ! $user = \Auth::user()) {
            return false;
        }

        if ( ! $invite instanceof UserInvite) {
            $invite = UserInvite::find($invite);
        }

        $accept = InviteUserStatus::where('status', 'accepted')->first();

        //Меняем статус заявки на принятую
        $invite->status_id = $accept->id;
        $invite->save();

        //Добавляем пользователя в команду
        $team = $invite->team;
        $user->team_id = $team->id;
        $user->save();

        return true;
    }

    /**
     * Отклонить приглашение.
     *
     * @param $invite
     * @return bool
     */
    public function declineInvite($invite)
    {
        if ( ! $user = \Auth::user()) {
            return false;
        }

        if ( ! $invite instanceof UserInvite) {
            $invite = UserInvite::find($invite);
        }

        $decline = InviteUserStatus::where('status', 'decline')->first();

        //Меняем статус заявки на отклоненную
        $invite->status_id = $decline->id;
        $invite->save();

        return true;
    }

}