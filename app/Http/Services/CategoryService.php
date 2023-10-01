<?php
namespace App\Http\Services;

use App\Enums\TypeCategory;
use App\Http\Contracts\Repositories\CategoryRepositoryContract;
use App\Http\Contracts\Services\CategoryServiceContract;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\Traits\ForwardCallToEloquentRepository;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;

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
        $category = $this->categoryRepository->find($id);
        if ($category && $this->canDelete($category)) {
            $category->delete();
            return Response::HTTP_OK;
        }
        return Response::HTTP_BAD_REQUEST;
    }

    public function blogCategories()
    {
        return $this->categoryRepository->getCategoriesByType(TypeCategory::Blog);
    }

    public function roomCategories()
    {
        return $this->categoryRepository->getCategoriesByType(TypeCategory::Room);
    }

    private function canDelete(Category $category)
    {
        if ($category->type === TypeCategory::Room) {
            return $this->canDeleteRoomCategory($category);
        }
        return $this->canDeleteBlogCategory($category);
    }

    private function canDeleteRoomCategory(Category $category)
    {
        return !$category->rooms()->exists();
    }

    private function canDeleteBlogCategory(Category $category)
    {
        return !$category->blogs()->exists();
    }
}