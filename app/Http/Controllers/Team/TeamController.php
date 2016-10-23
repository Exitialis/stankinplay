<?php

namespace App\Http\Controllers\Team;

use App\Http\Requests\Team\StoreRequest;
use App\Http\Controllers\Controller;
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
     * @return mixed
     */
    public function get()
    {
        $team = \Auth::user()->team()->with('discipline')->first();

        return response()->json(compact('team'));
    }

    public function store(StoreRequest $request)
    {
        $team = $this->teams->create([
            'name' => $request->input('name'),
            'discipline_id' => $request->input('discipline'),
            'captain_id' => \Auth::user()->id
        ]);

        if ( ! $team) {
            return response()->json(flash('При создании команды произошла ошибка', 'error'));
        }

        $user = \Auth::user();
        $user->team_id = $team->id;
        $user->save();

        return response()->json(flash('Команда успешно создана!'));
    }
}
