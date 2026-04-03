<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Str::macro('slugify', function ($title) {
            return Str::of($title)
                ->lower()
                ->replace(' ', '-')
                ->replaceMatches('/[^a-z0-9\-]/', '')
                ->replaceMatches('/-+/', '-')
                ->trim('-');
    });
    }
}
