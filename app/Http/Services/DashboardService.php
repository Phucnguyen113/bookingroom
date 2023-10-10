<?php
namespace App\Http\Services;

use App\Http\Contracts\Repositories\BlogRepositoryContract;
use App\Http\Contracts\Repositories\CategoryRepositoryContract;
use App\Http\Contracts\Repositories\RoomRepositoryContract;
use App\Http\Contracts\Repositories\UserRepositoryContract;

class DashboardService
{
    protected $blogRepository;
    protected $categoryRepository;
    protected $roomRepository;
    protected $userRepository;

    public function __construct(BlogRepositoryContract $blogRepository, CategoryRepositoryContract $categoryRepository, RoomRepositoryContract $roomRepository, UserRepositoryContract $userRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->categoryRepository = $categoryRepository;
        $this->roomRepository = $roomRepository;
        $this->userRepository = $userRepository;
    }

    public function analyst()
    {
        $totalBlog = $this->blogRepository->count();
        $totalCategory = $this->categoryRepository->count();
        $totalRoom = $this->roomRepository->count();
        $totalUser = $this->userRepository->count();
        $charData = $this->chartData();
        return compact('totalBlog', 'totalCategory', 'totalRoom', 'totalUser', 'charData');
    }

    public function chartData()
    {
       $data =  $this->roomRepository->roomsWithHighestView();
       $barData = $data->map(fn ($item) => [$item->id, $item->view_count])->toArray();

       $ticks = $data->map(fn ($item) => [$item->id, $item->name])->toArray();

        return compact('barData', 'ticks');
    }
}