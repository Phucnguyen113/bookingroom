<?php
namespace App\Http\Services;

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
        ]);
    }

    public function delete(string $id)
    {
        $this->categoryRepository->where('id', $id)->delete();
    }
}