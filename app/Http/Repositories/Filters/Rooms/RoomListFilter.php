<?php
namespace App\Http\Repositories\Filters\Rooms;

use App\Enums\RoomPriceFilter;
use App\Http\Repositories\Filters\Filters;
use Illuminate\Contracts\Database\Eloquent\Builder;

class RoomListFilter extends Filters
{
    protected array $whereAble = [
        'categories',
        'price',
        'quickSearch',
    ];

    public array $enableScopes = [
        'filter',
        'sort',
    ];

    public function whereCategories(Builder $builder)
    {
        $request = $this->request;
        if (isset($request['categories'])) {
            $builder->whereHas('categories', function ($_builder) use ($request) {
                $_builder->where('categories.id', $request['categories']);
            });
        }
    }

    public function wherePrice(Builder $builder)
    {
        $request = $this->request;

        if (isset($request['price']) && RoomPriceFilter::hasKey($request['price'])) {
            $model = $builder->getModel();
            $builder->whereBetween($model->qualifyColumn('price'), RoomPriceFilter::getValue($request['price']));
        }
    }

    public function whereQuickSearch(Builder $builder)
    {
        $request = $this->request;

        if (isset($request['quickSearch'])) {
            $model = $builder->getModel();
            $fillable = $model->getFillable();
            $value = $request['quickSearch'];
            foreach ($fillable as $key => $column) {
                $method = 'where';
                if ($key > 0) {
                    $method = 'orWhere';
                }
                $builder->{$method}($model->qualifyColumn($column), 'LIKE', "%$value%");
            }
        }
    }

    public function sort(Builder $builder)
    {
        $request = $this->request;
        $model = $builder->getModel();
        foreach ($request['sortDdesc'] ?? [] as $key => $column) {
            $builder->orderByDesc($model->qualifyColumn($column));
        }
        foreach ($request['sortAsc'] ?? [] as $key => $column) {
            $builder->orderBy($model->qualifyColumn($column));
        }
    }
}