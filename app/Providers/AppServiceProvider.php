<?php

namespace App\Providers;

use App\Http\Contracts\Repositories\UserRepositoryContract;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $repositories = [
        UserRepositoryContract::class => UserRepository::class
    ];

    protected $services = [

    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerRepositories();
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
            $this->app->singleton($abstract, fn () => $repo);
        }
    }
}
