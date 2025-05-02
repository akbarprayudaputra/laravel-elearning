<?php

namespace App\Providers;

use App\Services\CourseService;
use App\Services\Implementation\CourseServiceImpl;
use Illuminate\Support\ServiceProvider;

class CourseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CourseService::class, function () {
            return new CourseServiceImpl();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
