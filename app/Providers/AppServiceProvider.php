<?php

namespace App\Providers;

use App\Http\Contracts\Repositories\BlogRepositoryContract;
use App\Http\Contracts\Repositories\CategoryRepositoryContract;
use App\Http\Contracts\Repositories\MetaTagRepositoryContract;
use App\Http\Contracts\Repositories\RoomRepositoryContract;
use App\Http\Contracts\Repositories\UserRepositoryContract;
use App\Http\Contracts\Services\BlogServiceContract;
use App\Http\Contracts\Services\CategoryServiceContract;
use App\Http\Contracts\Services\MetaTagServiceContract;
use App\Http\Contracts\Services\RoomServiceContract;
use App\Http\Contracts\Services\SessionContract;
use App\Http\Repositories\BlogRepository;
use App\Http\Repositories\CategoryRepository;
use App\Http\Repositories\MetaTagRepository;
use App\Http\Repositories\RoomRepository;
use App\Http\Repositories\UserRepository;
use App\Http\Services\BlogService;
use App\Http\Services\CategoryService;
use App\Http\Services\MetaTagService;
use App\Http\Services\RoomService;
use App\Http\Services\SessionService;
use App\Http\Support\OptimizeImage;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $repositories = [
        UserRepositoryContract::class => UserRepository::class,

        MetaTagRepositoryContract::class => MetaTagRepository::class,

        BlogRepositoryContract::class => BlogRepository::class,

        RoomRepositoryContract::class => RoomRepository::class,

        CategoryRepositoryContract::class => CategoryRepository::class,
    ];

    protected $services = [
        SessionContract::class => SessionService::class,

        MetaTagServiceContract::class => MetaTagService::class,

        BlogServiceContract::class => BlogService::class,

        RoomServiceContract::class => RoomService::class,

        CategoryServiceContract::class => CategoryService::class,
    ];

    protected $facades = [

    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerServices();
        $this->registerFacades();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
        Paginator::useBootstrapFour();
    }

    public function registerRepositories()
    {
        foreach ($this->repositories as $abstract => $repo) {
            $this->app->bind($abstract, $repo);
        }
    }

    public function registerServices()
    {
        foreach ($this->services as $abstract => $service) {
            $this->app->bind($abstract, $service);
        }
    }

    public function registerFacades()
    {
        foreach ($this->facades as $facade => $concrete) {
            $this->app->bind($facade, $concrete);
        }
    }
}
