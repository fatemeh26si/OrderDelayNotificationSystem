<?php

namespace App\Repository;


use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function all();
    public function create(array $data);
    public function update(array $data, $id);
    public function destroy($id);
    public function find($id);
    public function findWithCondition($conditions);
    public function findWhereIn($field,$value);
    public function getModel();
    public function lastId();
    public function page($pages=10);
    public function setModel($model);
    public function with($relations);
    public function firstOrCreate($uniqueKeys, $params);
    public function updateOrCreate($uniqueKeys, $params);
}
