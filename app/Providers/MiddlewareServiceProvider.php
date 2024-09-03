<?php

namespace App\Providers;

use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\ServiceProvider;

class MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        // If you want to register a route middleware alias
        $this->app['router']->aliasMiddleware('guest', RedirectIfAuthenticated::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
