<?php

namespace App\Providers;

use App\Repositories\Auth\AuthModelRepository;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Product\ProductModelRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Dashboard\DashboardModelRepository;
use App\Repositories\Dashboard\DashboardRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepository::class, AuthModelRepository::class);
        $this->app->bind(ProductRepository::class, ProductModelRepository::class);
        $this->app->bind(DashboardRepository::class, DashboardModelRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
