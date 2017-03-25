<?php

namespace App\Managers;

use Illuminate\Database\Eloquent\Model;

class ApiManager
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function find(array $inputs)
    {
        return $this->model->where($this->getWhere($inputs))
            ->with()
            ->paginate(10);
    }

    protected function getWhere($inputs)
    {
        $where = [];
        $fields = $this->model->getVisible();

        foreach ($inputs as $inputKey => $inputValue) {
            if (isset($fields[$inputKey])) {
                $where[] = [$inputKey, 'LIKE', $inputValue . '%'];
            }
        }

        return $where;
    }

    protected function getWith($inputs)
    {
        $with = [];
        $relations = [
            'university_profile' => [
                'group' => [
                    'name' => 'ИДБ-14-'
                ]
            ]
        ];

        foreach ($inputs['relations'] as $relation) {
            if (is_array($relation)) {
                $this->getWith($relation);
            }

            
        }
    }
}