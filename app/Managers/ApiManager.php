<?php

namespace App\Managers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ApiManager
{
    /**
     * @var Model
     */
    protected $model;

    protected $with;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->with = [];
    }

    public function find(array $inputs)
    {
        $this->with = [];

        $query = $this->model->where($this->getWhere($inputs));

        if (isset($inputs['relations'])) {
            $this->getWith($inputs['relations']);

            if ($this->with) {
                $query->with($this->with);
            }
        }

        return $query->paginate(10);
    }

    protected function getWhere($inputs): array
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

    protected function getWith($relations, $parent = null)
    {
        if (is_array($relations)) {
            foreach ($relations as $relationKey => $relationValue) {
                if (is_array($relationValue)) {
                    //Если мы смогли найти и получить связь, то тогда
                    //пытаемся зарезолвить рекурсивно все остальные связи
                    //и также, добавить дополнительную выборку по полям и их значениям
                    if ($relationInstance = $this->getRelationInstance($relationKey)) {
                        //Если есть поле relations, то тогда вызываем эту функцию еще разок
//                        if (isset($relationValue['relations'])) {
//                            $this->getWith($relationValue['relations'], $relationKey);
//                        }
                        //TODO: Добавить условие для повышения производительности.
                        //if(count($relationValue) > 1 || ( ! isset($relationValue['relations']) && count($relationValue) >= 1)) {

                            //Получаем поля, по которым будем осуществлять поиск.
                            $searchFields = $relationInstance->getVisible();

                            $relationWhere = [];

                            foreach ($searchFields as $key => $value) {
                                //Если поле содержится в relation массиве, то добавляем его к поиску
                                if (in_array($key, $relationValue)) {
                                    $relationWhere[] = [$key, 'LIKE', $value.'%'];
                                }
                            }

                            $this->with[$relationKey] = function($query) use($relationWhere) {
                                $query->where($relationWhere);
                            };
                        //}
                    }
                } else {
                    $this->with[] = $relationKey;
                }
            }
        } else {
            if ($relationInstance = $this->getRelationInstance($relations)) {
                $this->with[] = $relations;
            }
        }
    }

    private function getRelationInstance(string $relation)
    {
        //Если связь определена в модели
        //то получаем инстанс связи
        if (method_exists($this->model, $relation)) {
            return $this->model->$relation()->getRelated();
        }

        return null;
    }
}