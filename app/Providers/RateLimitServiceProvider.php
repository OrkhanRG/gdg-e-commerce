<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class RateLimitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        RateLimiter::for('registration', function ($job) {
            return Limit::perHour(1)->by($job->ip());
        });

        RateLimiter::for('login', function ($job) {
            return Limit::perHour(60)->by($job->ip());
        });
    }
}
