<?php

namespace App\Http\Controllers\Users;

use App\Models\Team;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * UserController constructor.
     * @param $users
     */
    public function __construct(UserRepositoryContract $users)
    {
        $this->users = $users;
    }

    /**
     * Получить пользователей по дисциплине.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function get(Request $request)
    {
        if ($request->has('discipline')) {
            $captain = \Auth::user();
            if ($captain->can(['create-team', 'edit-team'])) {
                if ($captain->ownTeam) {
                    $team = $captain->ownTeam;

                    $users = $this->users->getByDisciplineAndTeam($request->input('discipline'), $team);

                    return response()->json($users);
                }
            }
        }

        return response('');
    }
}
