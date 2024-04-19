<?php

namespace App\Repository\Eloquent;


use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{

    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    public function lastId()
    {
        return $this->model->withTrashed()->max('id');
    }

    //Get all instances paging of model
    public function page($pages=10){
        return $this->model->paginate($pages);
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)->update($data);
    }

    // find record in the database
    public function find($id){
        return  $this->model->find($id);
    }

    // remove record from the database
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }



    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }


    public function findWithCondition($conditions)
    {
        return $this->model->where($conditions);
    }

    public function findWhereIn($field,$value)
    {
        return $this->model->whereIn($field,$value)->get();
    }

    public function firstOrCreate($uniqueKeys, $params)
    {
        return $this->model->firstOrCreate($uniqueKeys,$params);
    }
    public function updateOrCreate($uniqueKeys, $params)
    {
        return $this->model->updateOrCreate($uniqueKeys,$params);
    }

}




