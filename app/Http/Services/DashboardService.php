<?php
namespace App\Http\Services;

use App\Http\Contracts\Repositories\BlogRepositoryContract;
use App\Http\Contracts\Repositories\CategoryRepositoryContract;
use App\Http\Contracts\Repositories\RoomRepositoryContract;

class DashboardService
{
    protected $blogRepository;
    protected $categoryRepository;
    protected $roomRepository;

    public function __construct(BlogRepositoryContract $blogRepository, CategoryRepositoryContract $categoryRepository, RoomRepositoryContract $roomRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->categoryRepository = $categoryRepository;
        $this->roomRepository = $roomRepository;
    }

    public function analyst()
    {
        $totalBlog = $this->blogRepository->count();
        $totalCategory = $this->categoryRepository->count();
        $totalRoom = $this->roomRepository->count();

        return compact('totalBlog', 'totalCategory', 'totalRoom');
    }
}