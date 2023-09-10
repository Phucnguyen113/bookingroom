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

    public function __call($name, $arguments)
    {
        return $this->model->{$name}(...$arguments);
    }

}