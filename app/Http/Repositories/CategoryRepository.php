<?php
namespace App\Http\Repositories;

use App\Enums\TypeCategory;
use App\Http\Contracts\Repositories\CategoryRepositoryContract;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends EloquentRepository implements CategoryRepositoryContract
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getCategoriesByType(string $type, array|string $select = '*'): Collection
    {
        if (!in_array($type, TypeCategory::getValues())) {
            throw new \Exception('Invalid type category');
        }
        return $this->model->where('type', $type)->get($select);
    }
}