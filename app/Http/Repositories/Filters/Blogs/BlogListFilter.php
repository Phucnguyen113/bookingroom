<?php
namespace App\Http\Repositories\Filters\Blogs;

use App\Http\Repositories\Filters\Filters;
use Illuminate\Database\Eloquent\Builder;

class BlogListFilter extends Filters
{
    protected array $whereAble = [
        'categories',
    ];

    public array $enableScopes = [
        'filter',
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
}