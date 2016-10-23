<?php

namespace App\Http\Controllers\Invites;

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

        if ( ! $invite) {
            return response()->json(compact(flash('Невозможно отправить приглашение', 'error')));
        }

        return response()->json(compact(flash('Приглашение отправлено!'), 'invite'));
    }
}