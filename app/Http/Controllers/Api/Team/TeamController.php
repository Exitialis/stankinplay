<?php

namespace App\Http\Controllers\Api\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\StoreRequest;
use App\Models\Team;
use App\Models\User;
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
     *
     * @param TeamRepositoryContract $teams
     * @param UserRepositoryContract $users
     */
    public function __construct(TeamRepositoryContract $teams, UserRepositoryContract $users)
    {
        $this->teams = $teams;
        $this->users = $users;
    }

    /**
     * Получить список команд.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(Request $request)
    {

        $teams = Team::with(['discipline', 'captain', 'members'])->paginate(10);

//        $teams = Team::select('teams.*')->join('disciplines as disc', 'teams.discipline_id', '=', 'disc.id')
//                                        ->join('users as captain', 'captain.id', '=', 'teams.captain_id')
//                                        ->with(['discipline', 'captain', 'members']);

        /*if ($request->has('orderBy')) {
            $orderBy = $request->input('orderBy');

            foreach ($orderBy as $order) {

            }
        }*/

        //$teams = $teams->paginate(10);

        return response()->json($teams);
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
        $user = $request->user('api');

        if ( ! $user->discipline->first()->team) {
            return response()->json(flash('Для вашей дисциплины невозможно создание команды', 'error'));
        }

        $team = $this->teams->create([
            'name' => $request->input('name'),
            'discipline_id' => $user->discipline->first()->id,
            'captain_id' => $user->id
        ]);

        if ( ! $team) {
            return response()->json(flash('При создании команды произошла ошибка', 'error'));
        }

        $user->team()->sync([$team->id]);

        $team->load(['discipline', 'members']);

        return response()->json(compact('team', flash('Команда успешно создана!')));
    }

    public function getUsers(Request $request)
    {
        $user = auth('api')->user();
        if ($user->can(['create-team', 'edit-team'])) {
            $team = $user->ownTeam()->first();

            if( ! $team) {
                return response()->json('Команда не найдена', 422);
            }

            $users = User::whereHas('discipline', function($query) use($team) {
                $query->where('id', $team->discipline()->first()->id);
            })
                ->whereHas('team', function($query) use($team){
                    $query->where('id', '<>', $team->id)->orWhere('id', null);
                })
                ->whereHas('invites', function($query) use($team) {
                    $query->where('team_id', $team->id);
                }, 0)
                ->select('id', 'login as name')
                ->get();

            return response()->json($users);
        }

        abort(403, 'Доступ запрещен');
    }
}
