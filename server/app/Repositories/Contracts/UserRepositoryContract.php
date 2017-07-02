<?php

namespace App\Repositories\Contracts;

use App\Models\Team;
use Illuminate\Http\Request;

interface UserRepositoryContract extends BaseRepositoryContract
{
    public function saveUser(Request $request);

    public function getByDisciplineAndTeam(Team $team);
}