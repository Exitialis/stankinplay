<?php

namespace App\Http\Controllers\Api\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\StoreRequest;
use App\Repositories\Contracts\TeamRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * @var TeamRepository
     */
    protected $teams;

    /**
     * Репозиторий с пользователями.
     *
     * @var UserRepositoryContract
     */
    protected $users;

    /**
     * TeamController constructor.
     */
    public function __construct(TeamRepositoryContract $teams, UserRepositoryContract $users)
    {
        $this->teams = $teams;
        $this->users = $users;
    }

    /**
     * Получить команду пользователя с дициплиной и участниками.
     *
     * @return mixed
     */
    public function get()
    {
        $team = auth('api')->user()->team()->with(['discipline', 'members'])->first();

        return response()->json(compact('team'));
    }
    
    public function store(StoreRequest $request)
    {
        $user = \Auth::user();

        if ( ! $user->discipline->first()->team) {
            return response()->json(flash('Для вашей дисциплины невозможно создание команды', 'error'));
        }

        $team = $this->teams->create([
            'name' => $request->input('name'),
            'discipline_id' => $user->discipline->first(),
            'captain_id' => \Auth::user()->id
        ]);

        if ( ! $team) {
            return response()->json(flash('При создании команды произошла ошибка', 'error'));
        }

        $user->team_id = $team->id;
        $user->save();

        $team->load(['discipline', 'members']);

        return response()->json(compact('team', flash('Команда успешно создана!')));
    }

    public function getUsers(Request $request)
    {
        $user = auth('api')->user();
        if ($user->can(['create-team', 'edit-team'])) {
            $team = $user->ownTeam()->first();

            $users = $this->users->getByDisciplineAndTeam($team);

            return response()->json($users);
        }

        abort(403, 'Доступ запрещен');
    }
}
