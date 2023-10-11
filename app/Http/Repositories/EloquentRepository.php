<?php
namespace App\Http\Repositories;

use App\Http\Contracts\Repositories\Eloquent;
use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository implements Eloquent {
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function model()
    {
        if (!$this->model instanceof Model) {
            throw new \Exception('Oop, proterty model is not instance of Model');
        }
        return $this->model;
    }

    public function __call($name, $arguments)
    {
        return $this->model->{$name}(...$arguments);
    }

    public function __get($name)
    {
        return $this->model->{$name};
    }
}