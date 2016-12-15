<?php

namespace App\Managers;

use App\Models\Role;
use App\Models\UniversityProfile;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AuthManager
{
    /**
     * Репозиторий пользователей.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * UserManager constructor.
     */
    public function __construct()
    {
        $this->users = app(UserRepositoryContract::class);
    }

    /**
     * Зарегистрировать пользователя.
     *
     * @param Request $request
     * @return bool
     */
    public function register(Request $request)
    {
        $user = $this->users->saveUser($request);

        $universityProfile = UniversityProfile::create([
            'user_id' => $user->id,
            'group_id' => $request->input('group_id'),
            'module' => $request->input('module')
        ]);

        if ( ! $user) {
            return false;
        }

        $playerRole = Role::where('name', 'player')->firstOrFail();

        if ($request->input('captain')) {
            //Если в дисциплине нет команд
            if ( ! $user->discipline->team) {
                $user->attachRole($playerRole);
                return $user;
            }

            if ( ! $captain = Role::where('name', 'captain')->firstOrFail()) {
                $user->delete();
                return false;
            }

            $user->attachRole($captain);

            return $user;
        }

        $user->attachRole($playerRole);

        return $user;
    }


}