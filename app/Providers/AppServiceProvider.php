<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Str;

use Illuminate\Support\Stringable;
use Mockery\MockInterface;


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
     Stringable::macro('slugify', function ($title) {
            return str($title)
                ->lower()
                ->replace(' ', '-')
                ->replaceMatches('/[^a-z0-9\-]/', '')
                ->replaceMatches('/-+/', '-')
                ->trim('-');
    });
    }
}
