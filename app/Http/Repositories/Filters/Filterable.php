<?php
namespace App\Http\Repositories\Filters;

interface Filterable
{
    public function addFilter(Filters $filter);

    public function applyFilter();

    public function applySort();

}