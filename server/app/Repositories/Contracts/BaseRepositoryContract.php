<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryContract
{
    /**
     * Получить все сущности.
     *
     * @return mixed
     */
    public function all();

    /**
     * Получить сущность по id.
     *
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Найти модель или выбросить ошибку.
     *
     * @param $id
     * @return mixed
     */
    public function findOrFail($id);

    /**
     * Создать новую сущность.
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Обновить сущность.
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes);

    /**
     * Удалить сущность из базы.
     *
     * @param $id
     * @return mixed
     */
    public function delete($id);
}