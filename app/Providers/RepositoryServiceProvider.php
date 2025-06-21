<?php

namespace App\Providers;

use App\Repositories\Auth\AuthModelRepository;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Product\ProductModelRepository;
use App\Repositories\Product\ProductRepository;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
