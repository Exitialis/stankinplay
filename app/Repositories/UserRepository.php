<?php

namespace App\Repositories;

use App\Models\Team;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Http\Request;

class UserRepository extends BaseRepository implements UserRepositoryContract
{

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Создать нового пользователя.
     *
     * @param Request $request
     * @return User
     */
    public function saveUser(Request $request)
    {
        return $this->model->firstOrCreate(['login' => $request->input('login')], [
            'login' => $request->input('login'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'middle_name' => $request->input('middle_name'),
            'group' => $request->input('group'),
            'discipline_id' => $request->input('discipline'),
        ]);
    }

    /**
     * Найти пользователей по дисциплине.
     *
     * @param $discipline
     * @param Team $team
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getByDisciplineAndTeam($discipline, Team $team)
    {
        return $this->model->where('discipline_id', $discipline)
                            ->where('team_id', '<>', $team->id)
                            ->orWhere('team_id', NULL)
                            ->whereHas('invites', function($query) use($team) {
                                $query->where('team_id', $team->id);
                            }, 0)
                            ->select('id', 'login as name')
                            ->get();
    }

}