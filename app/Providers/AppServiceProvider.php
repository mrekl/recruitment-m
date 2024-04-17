<?php

namespace App\Providers;

use App\Services\VideoService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(VideoService::class, function ($app) {
            return new VideoService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('local')) {
            Artisan::call('migrate:refresh --seed');
        }
    }
}
