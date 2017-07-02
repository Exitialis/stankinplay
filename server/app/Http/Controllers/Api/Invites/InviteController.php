<?php

namespace App\Http\Controllers\Api\Invites;

use App\Managers\InviteManager;
use App\Models\UserInvite;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InviteController extends Controller
{

    /**
     * @var InviteManager
     */
    protected $manager;

    /**
     * InviteController constructor.
     */
    public function __construct()
    {
        $this->manager = new InviteManager();
    }

    /**
     * Получить приглашения текущего авторизованного пользователя.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        $invites = $this->manager->getUserInvites();

        return response()->json(compact('invites'));
    }

    /**
     * Получить приглашения от лица команды.
     *
     * @param $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTeamInvites($team)
    {
        $invites = $this->manager->getTeamInvites($team);

        return response()->json(compact('invites'));
    }

    /**
     * Отправить пришлашение пользователю на вступление в команду.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendInvitation(Request $request)
    {
        $this->validate($request, [
            'team_id' => 'required|exists:teams,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $invite = $this->manager->inviteUser($request->input('team_id'), $request->input('user_id'));

        $invite->load(['status', 'inviter', 'invited']);

        if ( ! $invite) {
            return response()->json(compact(flash('Невозможно отправить приглашение', 'error')));
        }

        return response()->json(compact(flash('Приглашение отправлено!'), 'invite'));
    }

    /**
     * Принять приглашение в команду.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function processInvite(Request $request)
    {
        $this->validate($request, [
            'invite_id' => 'required|exists:user_invites,id',
            'action' => 'required|in:accept,decline'
        ]);

        if ($request->input('action') === 'accept') {
            if ( ! $status = $this->manager->acceptInvite($request->input('invite_id'))) {
                return response()->json(compact(flash('Невозможно принять приглашение', 'error')));
            }

            return response()->json(compact(flash('Приглашение успешно принято!'), 'status'));
        } else if($request->input('action') === 'decline') {
            if ( ! $status = $this->manager->declineInvite($request->input('invite_id'))) {
                return response()->json(compact(flash('Невозможно отменить приглашение', 'error')));
            }

            return response()->json(compact(flash('Приглашение успешно отклонено!'), 'status'));
        }

        return response()->json(['status' => false]);
    }
}
