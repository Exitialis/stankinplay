<?php

namespace App\Repositories;

use App\Repositories\Contracts\DisciplineRepositoryContract;
use App\Models\Discipline;

class DisciplineRepository extends BaseRepository implements DisciplineRepositoryContract
{
    /**
     * DisciplineRepository constructor.
     * @param Discipline $discipline
     */
    public function __construct(Discipline $discipline)
    {
        $this->model = $discipline;
    }
}
