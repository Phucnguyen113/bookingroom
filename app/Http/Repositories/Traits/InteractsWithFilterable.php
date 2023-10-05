<?php
namespace App\Http\Repositories\Traits;

use App\Http\Repositories\Filters\Filters;

trait InteractsWithFilterable
{
    protected $filter;

    public function addFilter(Filters $filter)
    {
       $this->filter = $filter;
    }

    public function applyFilter()
    {
        if (method_exists($this, 'registerFilter')) {
            $this->registerFilter();
        }
        if (!$this->filter instanceof Filters) {
            throw new \Exception('proterty filter not is instance of Filterable');
        }
        $query = $this->query();
        $this->filter->applyFilter($query);

        return $query;
    }

    public function applySort()
    {

    }
}