<?php

namespace App\Providers;

use App\Http\Contracts\Repositories\MetaTagRepositoryContract;
use App\Http\Contracts\Repositories\UserRepositoryContract;
use App\Http\Contracts\Services\MetaTagServiceContract;
use App\Http\Contracts\Services\SessionContract;
use App\Http\Repositories\MetaTagRepository;
use App\Http\Repositories\UserRepository;
use App\Http\Services\MetaTagService;
use App\Http\Services\SessionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $repositories = [
        UserRepositoryContract::class => UserRepository::class,
        MetaTagRepositoryContract::class => MetaTagRepository::class,
    ];

    protected $services = [
        SessionContract::class => SessionService::class,
        MetaTagServiceContract::class => MetaTagService::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
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
}
