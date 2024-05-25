<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function boot()
    {
        RateLimiter::for('send-notification', function ($job) {
            return Limit::perMinute(30)->by($job->userId);
        });

        Carbon::mixin(new class {
            public function initializeDeserializeMillisecondsMixin()
            {
                Carbon::createFromFormat('Y-m-d H:i:s.u', '2023-05-25 12:34:56.123');
            }
        });
    }
}
