<?php

namespace App\Http\Controllers\Team;

use App\Http\Requests\Team\StoreRequest;
use App\Http\Controllers\Controller;
use App\Models\Discipline;
use App\Models\Team;
use App\Repositories\Contracts\TeamRepositoryContract;
use App\Repositories\TeamRepository;

class TeamController extends Controller
{
    /**
     * @var TeamRepository
     */
    protected $teams;

    /**
     * TeamController constructor.
     */
    public function __construct(TeamRepositoryContract $teams)
    {
        $this->teams = $teams;
    }

    /**
     * Получить команду пользователя с дициплиной и участниками.
     *
     * @return mixed
     */
    public function get()
    {
        $team = \Auth::user()->team()->with(['discipline', 'members'])->first();

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
}
