<?php
namespace App\Http\Repositories\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class FilterScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $model->applyEnableScopes($builder);
    }
}