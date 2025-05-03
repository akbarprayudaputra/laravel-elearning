<?php

namespace App\Providers;

use App\Services\EnrollmentService;
use App\Services\Implementation\EnrollmentServiceImpl;
use Illuminate\Support\ServiceProvider;

class EnrollmentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(EnrollmentService::class, function () {
            return new EnrollmentServiceImpl();
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
