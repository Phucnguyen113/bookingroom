<?php
namespace App\Http\Repositories\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface Filterable
{
    public function addFilter(Filters $filter);

    public function applyFilter(Builder $builder);

    public function applySort(Builder $builder);

}