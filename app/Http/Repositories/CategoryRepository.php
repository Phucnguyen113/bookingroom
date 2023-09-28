<?php
namespace App\Http\Repositories;

use App\Http\Contracts\Repositories\CategoryRepositoryContract;
use App\Models\Category;

class CategoryRepository extends EloquentRepository implements CategoryRepositoryContract
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}