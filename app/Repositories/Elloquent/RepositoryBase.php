<?php
namespace App\Repositories\Elloquent;

use Illuminate\Database\Eloquent\Model;

abstract class RepositoryBase implements RepositoryElloquentInterface
{
    /**      
     * @var Model      
    */   
    protected $model;

    public function __construct(Model $model)
    {   
        $this->model = $model;
    }

    /**
    * @return Model
    */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
    * @param $id
    * @return Model
    */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }
}