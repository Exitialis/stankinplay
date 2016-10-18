<?php

namespace App\Repositories;

use App\Repositories\Contracts\TeamRepositoryContract;
use App\Models\Team;

class TeamRepository extends BaseRepository implements TeamRepositoryContract
{
    /**
     * TeamRepository constructor.
     * @param Team $team
     */
    public function __construct(Team $team)
    {
        $this->model = $team;
    }
}
