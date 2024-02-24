<?php

namespace App\Http\Controllers\Api;

use App\Http\Contracts\Services\BlogServiceContract;
use App\Http\Contracts\Services\RoomServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomeResource;
use App\Http\Services\MetaInfoService;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        protected RoomServiceContract $roomService,
        protected BlogServiceContract $blogService,
        protected MetaInfoService $metaInfoService
    ) {}

    public function index()
    {
        $rooms = $this->roomService->getRoomHighestView(builder:function (Builder $query) {
            $query->with([
                'media',
                'tags',
                'customerFeedbacks',
            ]);
        });

        $metaInfo = $this->metaInfoService->with('media')->get();

        $blogs = $this->blogService->getBlogsHomePage();

        return HomeResource::make(compact('rooms', 'metaInfo', 'blogs'));
    }
}
