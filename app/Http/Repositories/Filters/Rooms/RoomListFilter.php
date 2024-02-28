<?php
namespace App\Http\Repositories\Filters\Rooms;

use App\Enums\RoomPriceFilter;
use App\Http\Repositories\Filters\Filters;
use Illuminate\Database\Eloquent\Builder;

class RoomListFilter extends Filters
{
    protected array $whereAble = [
        'categories',
        'price',
        'quickSearch',
        'startDate',
        'endDate',
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

            $builder->where(function (Builder $query) use ($fillable, $model, $value) {
                foreach ($fillable as $key => $column) {
                    $query->orWhere($model->qualifyColumn($column), 'LIKE', "%$value%");
                }
            });
        }
    }

    public function whereStartDate(Builder $builder)
    {
        $request = $this->request;
        if (isset($request['startDate'])) {
            $model = $builder->getModel();
            $builder->where(function (Builder $query) use ($model, $request) {
                $query->where($model->qualifyColumn('start_date'), '<=', $request['startDate'])
                    ->where($model->qualifyColumn('end_date'), '>=', $request['startDate']);
            });
        };
    }

    public function whereEndDate(Builder $builder)
    {
        $request = $this->request;
        if (isset($request['endDate'])) {
            $model = $builder->getModel();
            $builder->where(function (Builder $query) use ($model, $request) {
                $query->where($model->qualifyColumn('start_date'), '<=', $request['endDate'])
                    ->where($model->qualifyColumn('end_date'), '>=', $request['endDate']);
            });
        };
    }

    public function sort(Builder $builder)
    {
        $request = $this->request;
        $model = $builder->getModel();
        foreach ($request['sortDesc'] ?? [] as $key => $column) {
            $builder->orderByDesc($model->qualifyColumn($column));
        }
        foreach ($request['sortAsc'] ?? [] as $key => $column) {
            $builder->orderBy($model->qualifyColumn($column));
        }
    }
}