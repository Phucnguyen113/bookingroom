<?php
namespace App\Http\Services;

use App\Enums\TypeCategory;
use App\Http\Contracts\Repositories\CategoryRepositoryContract;
use App\Http\Contracts\Services\CategoryServiceContract;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\Traits\ForwardCallToEloquentRepository;

class CategoryService implements CategoryServiceContract
{
    use ForwardCallToEloquentRepository;

    protected $categoryRepository;

    public function __construct(CategoryRepositoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function update(CategoryRequest $request, string $id)
    {
        $this->categoryRepository->where('id', $id)
        ->update([
            'name' => $request->name,
            'type' => $request->type,
        ]);
    }

    public function delete(string $id)
    {
        $this->categoryRepository->where('id', $id)->delete();
    }

    public function blogCategories()
    {
        return $this->categoryRepository->getCategoriesByType(TypeCategory::Blog);
    }

    public function roomCategories()
    {
        return $this->categoryRepository->getCategoriesByType(TypeCategory::Room);
    }

}