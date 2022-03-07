<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Spatie\Activitylog\ActivitylogServiceProvider::class);

        $this->app->register(\Irazasyed\Larasupport\Providers\ArtisanServiceProvider::class);

        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->register(\Laravel\Tinker\TinkerServiceProvider::class);
    }
}
