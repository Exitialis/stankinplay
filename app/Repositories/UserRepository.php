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
            'discipline_id' => $request->input('discipline'),
            'login' => $request->input('login'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'middle_name' => $request->input('middle_name'),
        ]);
    }

    /**
     * Найти пользователей по дисциплине.
     *
     * @param $discipline
     * @param Team $team
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getByDisciplineAndTeam(Team $team)
    {
        $users = $this->model->whereHas('discipline', function($query) use($team) {
            $query->where('id', $team->discipline()->first()->id);
        })
            ->whereHas('team', function($query) use($team){
                $query->where('id', '<>', $team->id)->orWhere('id', null);
            })
            ->select('id', 'login as name')
            ->get();

        return response()->json(compact($users));
    }

}