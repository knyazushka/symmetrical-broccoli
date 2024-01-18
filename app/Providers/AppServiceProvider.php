<?php

namespace App\Providers;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Contracts\Repository\UserRepositoryContract;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use App\Contracts\Service\IdentityServiceContract;
use App\Services\IdentityService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // repository
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(ProductRepositoryContract::class, ProductRepository::class);

        // service
        $this->app->bind(IdentityServiceContract::class, IdentityService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
