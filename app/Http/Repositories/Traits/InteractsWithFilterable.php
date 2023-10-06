<?php
namespace App\Http\Repositories\Traits;

use App\Http\Repositories\Filters\Filters;
use App\Http\Repositories\Filters\FilterScope;
use Illuminate\Contracts\Database\Eloquent\Builder;

trait InteractsWithFilterable
{
    protected $filter;

    public function addFilter(Filters $filter)
    {
       $this->filter = $filter;
    }

    public function applyEnableScopes(Builder $builder)
    {
        if (!$this->filter instanceof Filters && method_exists($this, 'registerFilter')) {
            $this->registerFilter();
        }

        foreach ($this->filter->enableScopes as $key => $scope) {
            $ucScope = ucfirst($scope);
            $this->{"apply$ucScope"}($builder);
        }
    }

    public function applyFilter(Builder $builder)
    {
        if (!$this->filter instanceof Filters) {
            throw new \Exception('proterty filter not is instance of Filterable');
        }

        $this->filter->applyFilter($builder);
    }

    public function applySort(Builder $builder)
    {
        if (!$this->filter instanceof Filters) {
            throw new \Exception('proterty filter not is instance of Filterable');
        }

        $this->filter->applySort($builder);
    }

    public static function bootInteractsWithFilterable()
    {
        static::addGlobalScope(new FilterScope);
    }

}