<?php

namespace App\Providers;

use App\Repositories\Auth\AuthModelRepository;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use ProductModelRepository;
use ProductRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
