<?php
namespace App\Http\Repositories\Filters\Blogs;

use App\Enums\BlogPriceFilter;
use App\Http\Repositories\Filters\Filters;
use Illuminate\Database\Eloquent\Builder;

class BlogListFilter extends Filters
{
    protected array $whereAble = [
        'categories',
    ];

    public function whereCategories(Builder $builder)
    {
        $request = $this->request;
        if (isset($request['categories']) && $request['categories']) {
            $builder->whereHas('categories', function ($_builder) use ($request) {
                $_builder->where('categories.id', $request['categories']);
            });
        }
    }

    // public function wherePrice(Builder $builder)
    // {
    //     $request = $this->request;
    //     if (BlogPriceFilter::hasKey($request['price'])) {
    //         $builder->whereBetWeen('price', BlogPriceFilter::getValue($request['price']));
    //     }
    // }
}